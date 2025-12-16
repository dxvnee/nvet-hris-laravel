<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsenController extends Controller
{
    // Koordinat kantor (bisa dicustom)
    private $officeLatitude = -6.189035762950233;
    private $officeLongitude = 106.61662426529043;
    private $allowedRadius = 20; // meter

    public function index()
    {
        $today = Carbon::today();
        $user = Auth::user();

        // Ambil absen hari ini (single record per day)
        $absenHariIni = Absen::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        // Status berdasarkan model baru
        $sudahHadir = $absenHariIni && $absenHariIni->jam_masuk ? $absenHariIni : null;
        $sudahIzin = $absenHariIni && $absenHariIni->izin ? $absenHariIni : null;
        $sudahPulang = $absenHariIni && $absenHariIni->jam_pulang ? $absenHariIni : null;

        // Hitung total jam kerja hari ini
        $totalJamKerja = 0;
        $totalJamKerjaText = '0 jam 0 menit';
        if ($sudahHadir && !$sudahIzin) {
            $jamMasuk = $absenHariIni->jam_masuk;
            $jamKeluar = $absenHariIni->jam_pulang ?? Carbon::now();

            $totalMenit = $jamMasuk->diffInMinutes($jamKeluar, false);
            $jam = floor($totalMenit / 60);
            $menit = $totalMenit % 60;

            $totalJamKerja = $jam;
            $totalJamKerjaText = $jam . ' jam ' . $menit . ' menit';
        }

        // Riwayat absen
        $riwayat = Absen::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->limit(20)
            ->get();

        return view('absen', compact(
            'absenHariIni',
            'sudahHadir',
            'sudahIzin',
            'sudahPulang',
            'riwayat',
            'totalJamKerja',
            'totalJamKerjaText'
        ));
    }

    public function riwayat(Request $request)
    {
        $user = Auth::user();

        // Default sorting
        $sortBy = $request->get('sort_by', 'tanggal');
        $sortDirection = $request->get('sort_direction', 'desc');

        // Validasi kolom yang bisa di-sort
        $allowedSortColumns = ['tanggal', 'jam_masuk', 'jam_pulang', 'menit_kerja', 'izin', 'telat'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'tanggal';
        }

        // Validasi arah sorting
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $query = Absen::where('user_id', $user->id);

        // Sorting berdasarkan kolom
        if ($sortBy === 'tanggal') {
            $query->orderBy('tanggal', $sortDirection);
        } elseif ($sortBy === 'jam_masuk') {
            $query->orderBy('jam_masuk', $sortDirection);
        } elseif ($sortBy === 'jam_pulang') {
            $query->orderBy('jam_pulang', $sortDirection);
        } elseif ($sortBy === 'menit_kerja') {
            $query->orderBy('menit_kerja', $sortDirection);
        } elseif ($sortBy === 'izin') {
            $query->orderBy('izin', $sortDirection);
        } elseif ($sortBy === 'telat') {
            $query->orderBy('telat', $sortDirection);
        }

        // Secondary sort by tanggal desc untuk konsistensi
        if ($sortBy !== 'tanggal') {
            $query->orderBy('tanggal', 'desc');
        }

        $riwayat = $query->paginate(10)->appends(request()->query());

        return view('riwayat', compact(
            'riwayat',
            'sortBy',
            'sortDirection'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();

        // Ambil / buat data absen hari ini
        $absen = Absen::firstOrCreate(
            [
                'user_id' => $user->id,
                'tanggal' => $today,
            ],
            [
                'izin' => false,
                'telat' => false,
            ]
        );

        /* ===============================
     * VALIDASI LOKASI
     * =============================== */
        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $this->officeLatitude,
            $this->officeLongitude
        );

        if ($distance > $this->allowedRadius) {
            return back()->with(
                'error',
                'Anda berada di luar radius kantor. Jarak Anda: ' . round($distance, 2) . ' meter.'
            );
        }

        /* ===============================
     * HADIR
     * =============================== */
        if ($request->tipe === 'hadir') {

            if ($absen->jam_masuk) {
                return back()->with('error', 'Anda sudah absen masuk hari ini.');
            }

            // Determine jam masuk based on shift or non-shift
            $jamMasukSetting = Carbon::today()->setTime(9, 0); // Default
            $shiftNumber = null;

            if ($user->is_shift && $user->shift_partner_id) {
                // Check if partner already clocked in today
                $partnerAbsen = Absen::where('user_id', $user->shift_partner_id)
                    ->whereDate('tanggal', $today)
                    ->first();

                if ($partnerAbsen && $partnerAbsen->jam_masuk) {
                    // Partner already clocked in, this user is shift 2
                    $shiftNumber = 2;
                    $jamMasukSetting = Carbon::parse($user->shift2_jam_masuk);
                } else {
                    // This user is shift 1 (first to clock in)
                    $shiftNumber = 1;
                    $jamMasukSetting = Carbon::parse($user->shift1_jam_masuk);
                }
            } else {
                // Non-shift user
                if ($user->jam_masuk) {
                    $jamMasukSetting = Carbon::parse($user->jam_masuk);
                }
            }

            $batasAbsen = Carbon::today()
                ->setTime($jamMasukSetting->hour, $jamMasukSetting->minute)
                ->subMinutes(30);

            if ($now->lt($batasAbsen)) {
                return back()->with('error', 'Anda hanya bisa absen mulai 30 menit sebelum jam masuk (' . $jamMasukSetting->format('H:i') . ').');
            }

            $jamMasukToday = Carbon::today()->setTime($jamMasukSetting->hour, $jamMasukSetting->minute);
            $telat = $now->gt($jamMasukToday);

            $absen->update([
                'jam_masuk'   => $now,
                'telat'       => $telat,
                'menit_telat' => $telat ? $jamMasukToday->diffInMinutes($now) : 0,
                'lat_masuk'   => $request->latitude,
                'lng_masuk'   => $request->longitude,
                'shift_number' => $shiftNumber,
            ]);

            $shiftInfo = $shiftNumber ? " (Shift $shiftNumber)" : '';
            return back()->with(
                'success',
                'Absen masuk berhasil dicatat pukul ' . $now->format('H:i') . ($telat ? ' (TELAT)' : '') . $shiftInfo
            );
        }

        /* ===============================
     * PULANG
     * =============================== */
        if ($request->tipe === 'pulang') {

            if (!$absen->jam_masuk) {
                return back()->with('error', 'Anda belum melakukan absen masuk hari ini.');
            }

            if ($absen->jam_pulang) {
                return back()->with('error', 'Anda sudah absen pulang hari ini.');
            }

            if ($absen->izin) {
                return back()->with('error', 'Anda sudah izin pulang awal hari ini.');
            }

            // Determine jam pulang based on shift or non-shift
            $jamPulangSetting = Carbon::today()->setTime(20, 0); // Default

            if ($user->is_shift && $user->shift_partner_id) {
                // Use shift-specific jam keluar
                if ($absen->shift_number === 1) {
                    $jamPulangSetting = Carbon::today()->setTime(
                        Carbon::parse($user->shift1_jam_keluar)->hour,
                        Carbon::parse($user->shift1_jam_keluar)->minute
                    );
                } elseif ($absen->shift_number === 2) {
                    $jamPulangSetting = Carbon::today()->setTime(
                        Carbon::parse($user->shift2_jam_keluar)->hour,
                        Carbon::parse($user->shift2_jam_keluar)->minute
                    );
                }
            } else {
                // Non-shift user
                if ($user->jam_keluar) {
                    $jamPulangSetting = Carbon::today()->setTime(
                        Carbon::parse($user->jam_keluar)->hour,
                        Carbon::parse($user->jam_keluar)->minute
                    );
                }
            }

            if ($now->lt($jamPulangSetting)) {
                return back()->with('error', 'Absen pulang baru bisa dilakukan setelah jam ' . $jamPulangSetting->format('H:i') . ' WIB. Gunakan "Izin Pulang Awal" jika ingin pulang sebelum waktunya.');
            }

            $menitKerja = $absen->jam_masuk->diffInMinutes($now);

            $absen->update([
                'jam_pulang' => $now,
                'lat_pulang' => $request->latitude,
                'lng_pulang' => $request->longitude,
                'menit_kerja' => $menitKerja,
            ]);

            return back()->with(
                'success',
                'Absen pulang berhasil dicatat pukul ' . $now->format('H:i')
            );
        }

        /* ===============================
     * IZIN
     * =============================== */
        if ($request->tipe === 'izin') {

            // Jika belum hadir, ini adalah izin tidak masuk
            if (!$absen->jam_masuk) {
                if ($absen->izin) {
                    return back()->with('error', 'Anda sudah mengajukan izin hari ini.');
                }

                $absen->update([
                    'izin' => true,
                    'izin_keterangan' => $request->keterangan,
                ]);

                return back()->with('success', 'Izin tidak masuk berhasil dicatat.');
            }

            // Jika sudah hadir, ini adalah izin pulang awal
            if ($absen->jam_pulang) {
                return back()->with('error', 'Anda sudah absen pulang hari ini.');
            }

            if ($absen->izin) {
                return back()->with('error', 'Anda sudah mengajukan izin pulang awal hari ini.');
            }

            $menitKerja = $absen->jam_masuk->diffInMinutes($now);

            $absen->update([
                'izin' => true,
                'izin_keterangan' => $request->keterangan,
                'jam_pulang' => $now,
                'lat_pulang' => $request->latitude,
                'lng_pulang' => $request->longitude,
                'menit_kerja' => $menitKerja,
            ]);

            return back()->with('success', 'Izin pulang awal berhasil dicatat pukul ' . $now->format('H:i'));
        }
    }


    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
