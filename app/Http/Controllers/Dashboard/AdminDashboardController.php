<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\HariLibur;
use App\Models\Penggajian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Pastikan user adalah admin
        if ($user->role !== 'admin') {
            return redirect()->route('dashboard.pegawai');
        }

        $currentMonth = now()->format('Y-m');
        $today = now()->toDateString();
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Total pegawai
        $totalPegawai = User::where('role', 'pegawai')
            ->where('is_inactive', false)
            ->count();

        // Pegawai berdasarkan jabatan
        $pegawaiByJabatan = User::where('role', 'pegawai')
            ->where('is_inactive', false)
            ->selectRaw('jabatan, count(*) as total')
            ->groupBy('jabatan')
            ->pluck('total', 'jabatan')
            ->toArray();

        // Absensi hari ini (semua pegawai)
        $absensiHariIni = Absen::whereDate('tanggal', $today)
            ->whereNotNull('jam_masuk')
            ->count();

        $tepatWaktuHariIni = Absen::whereDate('tanggal', $today)
            ->where('menit_telat', 0)
            ->whereNotNull('jam_masuk')
            ->count();

        // Pegawai yang seharusnya kerja tapi belum absen hari ini
        $dayOfWeek = now()->dayOfWeek;
        $holiday = HariLibur::getHoliday($today);

        $semuaPegawaiAktif = User::where('role', 'pegawai')
            ->activeOnDate($today)
            ->get();

        // Filter: pegawai yang seharusnya kerja hari ini
        $sudahAbsenIds = Absen::whereDate('tanggal', $today)
            ->whereNotNull('jam_masuk')
            ->pluck('user_id')
            ->toArray();

        $belumAbsen = $semuaPegawaiAktif->filter(function ($pegawai) use ($dayOfWeek, $holiday) {
            // Cek hari libur mingguan pegawai
            $userHariLibur = $pegawai->hari_libur ?? [];
            $isUserDayOff = in_array($dayOfWeek, $userHariLibur);

            // Jika ada hari libur nasional/khusus
            if ($holiday) {
                return $holiday->shouldUserWork($pegawai);
            }

            // Jika hari libur mingguan pegawai, tidak wajib kerja
            return !$isUserDayOff;
        })->filter(function ($pegawai) use ($sudahAbsenIds) {
            return !in_array($pegawai->id, $sudahAbsenIds);
        });

        $belumAbsenCount = $belumAbsen->count();

        // Pegawai yang libur hari ini
        $pegawaiLibur = $semuaPegawaiAktif->filter(function ($pegawai) use ($dayOfWeek, $holiday) {
            $userHariLibur = $pegawai->hari_libur ?? [];
            $isUserDayOff = in_array($dayOfWeek, $userHariLibur);

            if ($holiday) {
                return !$holiday->shouldUserWork($pegawai);
            }

            return $isUserDayOff;
        });

        // Total gaji bulan ini
        $totalGajiBulanIni = Penggajian::where('periode', $currentMonth)
            ->where('status', 'final')
            ->sum('total_gaji');

        // Penggajian pending (draft)
        $penggajianDraft = Penggajian::where('status', 'draft')->count();

        // Count lupa pulang bulan ini
        $totalLupaPulangBulanIni = Absen::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->where('lupa_pulang', true)
            ->count();

        // Aktivitas absensi terbaru (10 terakhir)
        $aktivitasTerbaru = Absen::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->whereNotNull('jam_masuk')
            ->get();

        // Top pegawai telat bulan ini
        $topTelat = Absen::selectRaw('user_id, COUNT(*) as total_telat, SUM(menit_telat) as total_menit')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->where('menit_telat', '>', 0)
            ->groupBy('user_id')
            ->orderByDesc('total_menit')
            ->with('user')
            ->limit(5)
            ->get();

        // Grafik absensi 7 hari terakhir
        $grafikAbsensi = $this->getGrafikAbsensi();

        return view('pages.dashboard.admin', compact(
            'user',
            'today',
            'totalPegawai',
            'pegawaiByJabatan',
            'absensiHariIni',
            'tepatWaktuHariIni',
            'belumAbsenCount',
            'belumAbsen',
            'pegawaiLibur',
            'totalGajiBulanIni',
            'penggajianDraft',
            'aktivitasTerbaru',
            'topTelat',
            'grafikAbsensi',
            'totalLupaPulangBulanIni'
        ));
    }

    /**
     * Get grafik absensi 7 hari terakhir.
     */
    private function getGrafikAbsensi(): array
    {
        $grafikAbsensi = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $dateCarbon = Carbon::parse($date);
            $dow = $dateCarbon->dayOfWeek;
            $hol = HariLibur::getHoliday($date);

            $totalAktif = User::where('role', 'pegawai')->activeOnDate($date)->get();
            $harusKerja = $totalAktif->filter(function ($p) use ($dow, $hol) {
                $off = in_array($dow, $p->hari_libur ?? []);
                if ($hol) return $hol->shouldUserWork($p);
                return !$off;
            })->count();

            $hadir = Absen::whereDate('tanggal', $date)->whereNotNull('jam_masuk')->count();
            $belum = max($harusKerja - $hadir, 0);

            $grafikAbsensi[] = [
                'tanggal' => $dateCarbon->format('d M'),
                'hadir' => $hadir,
                'belum_absen' => $belum,
            ];
        }

        return $grafikAbsensi;
    }
}
