<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Penggajian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    /**
     * Display a listing of payrolls.
     */
    public function index(Request $request)
    {
        $periode = $request->get('periode', now()->format('Y-m'));

        $query = Penggajian::with('user')
            ->where('periode', $periode)
            ->orderBy('created_at', 'desc');

        $penggajian = $query->paginate(10)->withQueryString();

        // Get all employees for creating new payroll
        $employees = User::where('role', 'pegawai')->get();

        return view('penggajian.index', compact('penggajian', 'periode', 'employees'));
    }

    /**
     * Show the form for creating a new payroll.
     */
    public function create(Request $request)
    {
        $userId = $request->get('user_id');
        $periode = $request->get('periode', now()->format('Y-m'));

        $user = User::findOrFail($userId);

        // Check if payroll already exists
        $existing = Penggajian::where('user_id', $userId)->where('periode', $periode)->first();
        if ($existing) {
            return redirect()->route('penggajian.edit', $existing)->with('error', 'Penggajian untuk periode ini sudah ada!');
        }

        // Get attendance data for the period
        $startDate = Carbon::parse($periode . '-01')->startOfMonth();
        $endDate = Carbon::parse($periode . '-01')->endOfMonth();

        $absensi = Absen::where('user_id', $userId)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();

        $totalMenitTelat = $absensi->sum('menit_telat');
        $jamKerja = $user->jam_kerja ?? 8;
        $potonganPerMenit = round(($user->gaji_pokok / ($jamKerja * 26)) / 60);
        return view('penggajian.create', compact('user', 'periode', 'potonganPerMenit', 'totalMenitTelat', 'absensi'));
    }

    /**
     * Store a newly created payroll in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'periode' => 'required|string',
            'gaji_pokok' => 'required|numeric|min:0',
            'total_menit_telat' => 'required|integer|min:0',
            'potongan_per_menit' => 'required|integer|min:0',
            'insentif_detail' => 'nullable|array',
            'reimburse' => 'nullable|numeric|min:0',
            'keterangan_reimburse' => 'nullable|string',
            'lain_lain' => 'nullable|numeric',
            'keterangan_lain' => 'nullable|string',
            'catatan' => 'nullable|string',
            'status' => 'required|in:draft,final',
        ]);

        $user = User::findOrFail($request->user_id);

        // Calculate totals
        $gajiPokok = $request->gaji_pokok;
        $totalPotonganTelat = $request->total_menit_telat * $request->potongan_per_menit;
        $totalInsentif = $this->calculateInsentif($user->jabatan, $request->insentif_detail ?? []);
        $reimburse = $request->reimburse ?? 0;
        $lainLain = $request->lain_lain ?? 0;

        $totalGaji = $gajiPokok - $totalPotonganTelat + $totalInsentif - $reimburse + $lainLain;

        Penggajian::create([
            'user_id' => $request->user_id,
            'periode' => $request->periode,
            'gaji_pokok' => $gajiPokok,
            'total_menit_telat' => $request->total_menit_telat,
            'potongan_per_menit' => $request->potongan_per_menit,
            'total_potongan_telat' => $totalPotonganTelat,
            'insentif_detail' => $request->insentif_detail,
            'total_insentif' => $totalInsentif,
            'reimburse' => $reimburse,
            'keterangan_reimburse' => $request->keterangan_reimburse,
            'lain_lain' => $lainLain,
            'keterangan_lain' => $request->keterangan_lain,
            'total_gaji' => $totalGaji,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()->route('penggajian.index', ['periode' => $request->periode])
            ->with('success', 'Penggajian berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified payroll.
     */
    public function edit(Penggajian $penggajian)
    {
        $user = $penggajian->user;
        $periode = $penggajian->periode;

        // Get attendance data for the period
        $startDate = Carbon::parse($periode . '-01')->startOfMonth();
        $endDate = Carbon::parse($periode . '-01')->endOfMonth();

        $absensi = Absen::where('user_id', $user->id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();

        $totalMenitTelat = $absensi->sum('menit_telat');
        $jamKerja = $user->jam_kerja ?? 8;
        $potonganPerMenit = round(($user->gaji_pokok / ($jamKerja * 26)) / 60);

        return view('penggajian.edit', compact('penggajian', 'user', 'periode', 'absensi', 'totalMenitTelat', 'potonganPerMenit'));
    }

    /**
     * Update the specified payroll in storage.
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        $request->validate([
            'gaji_pokok' => 'required|numeric|min:0',
            'total_menit_telat' => 'required|integer|min:0',
            'potongan_per_menit' => 'required|integer|min:0',
            'insentif_detail' => 'nullable|array',
            'reimburse' => 'nullable|numeric|min:0',
            'keterangan_reimburse' => 'nullable|string',
            'lain_lain' => 'nullable|numeric',
            'keterangan_lain' => 'nullable|string',
            'catatan' => 'nullable|string',
            'status' => 'required|in:draft,final',
        ]);

        $user = $penggajian->user;

        // Calculate totals
        $gajiPokok = $request->gaji_pokok;
        $totalPotonganTelat = $request->total_menit_telat * $request->potongan_per_menit;
        $totalInsentif = $this->calculateInsentif($user->jabatan, $request->insentif_detail ?? []);
        $reimburse = $request->reimburse ?? 0;
        $lainLain = $request->lain_lain ?? 0;

        $totalGaji = $gajiPokok - $totalPotonganTelat + $totalInsentif - $reimburse + $lainLain;

        $penggajian->update([
            'gaji_pokok' => $gajiPokok,
            'total_menit_telat' => $request->total_menit_telat,
            'potongan_per_menit' => $request->potongan_per_menit,
            'total_potongan_telat' => $totalPotonganTelat,
            'insentif_detail' => $request->insentif_detail,
            'total_insentif' => $totalInsentif,
            'reimburse' => $reimburse,
            'keterangan_reimburse' => $request->keterangan_reimburse,
            'lain_lain' => $lainLain,
            'keterangan_lain' => $request->keterangan_lain,
            'total_gaji' => $totalGaji,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()->route('penggajian.index', ['periode' => $penggajian->periode])
            ->with('success', 'Penggajian berhasil diperbarui!');
    }

    /**
     * Remove the specified payroll from storage.
     */
    public function destroy(Penggajian $penggajian)
    {
        $periode = $penggajian->periode;
        $penggajian->delete();

        return redirect()->route('penggajian.index', ['periode' => $periode])
            ->with('success', 'Penggajian berhasil dihapus!');
    }

    /**
     * Print payroll slip.
     */
    public function print(Penggajian $penggajian)
    {
        // Check if user is admin or the payroll belongs to the authenticated user
        if (auth()->user()->role !== 'admin' && $penggajian->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('penggajian.print', compact('penggajian'));
    }

    /**
     * Calculate incentive based on job position.
     */
    private function calculateInsentif(string $jabatan, array $detail): float
    {
        $total = 0;

        switch ($jabatan) {
            case 'Dokter':
                // Transaksi - (Pengurangan + Penambahan)% + lain-lain
                $transaksi = floatval($detail['transaksi'] ?? 0);
                $pengurangan = floatval($detail['pengurangan'] ?? 0);
                $penambahan = floatval($detail['penambahan'] ?? 0);
                $persenan = floatval($detail['persenan'] ?? 0) / 100;
                $lainLain = floatval($detail['lain_lain_insentif'] ?? 0);

                $total = ($transaksi - $pengurangan + $penambahan) * $persenan + $lainLain;
                break;

            case 'Paramedis':
                // Antar jemput + Rawat inap + Visit + Grooming + lain-lain
                $antarJemput = (intval($detail['antar_jemput_qty'] ?? 0) * floatval($detail['antar_jemput_harga'] ?? 0));
                $rawatInap = (intval($detail['rawat_inap_qty'] ?? 0) * floatval($detail['rawat_inap_harga'] ?? 0));
                $visit = (intval($detail['visit_qty'] ?? 0) * floatval($detail['visit_harga'] ?? 0));
                $grooming = (intval($detail['grooming_qty'] ?? 0) * floatval($detail['grooming_harga'] ?? 0));
                $lainLain = floatval($detail['lain_lain_insentif'] ?? 0);

                $total = $antarJemput + $rawatInap + $visit + $grooming + $lainLain;
                break;

            case 'FO':
                // Review + Appointment + lain-lain
                $review = (intval($detail['review_qty'] ?? 0) * floatval($detail['review_harga'] ?? 0));
                $appointment = (intval($detail['appointment_qty'] ?? 0) * floatval($detail['appointment_harga'] ?? 0));
                $lainLain = floatval($detail['lain_lain_insentif'] ?? 0);

                $total = $review + $appointment + $lainLain;
                break;

            case 'Tech':
                // Antar konten + lain-lain
                $antarKonten = (intval($detail['antar_konten_qty'] ?? 0) * floatval($detail['antar_konten_harga'] ?? 0));
                $lainLain = floatval($detail['lain_lain_insentif'] ?? 0);

                $total = $antarKonten + $lainLain;
                break;
        }

        return $total;
    }

    /**
     * Display payroll history for the authenticated employee.
     */
    public function riwayatPegawai(Request $request)
    {
        $user = auth()->user();

        $query = Penggajian::where('user_id', $user->id)
            ->orderBy('periode', 'desc');

        $penggajian = $query->paginate(12)->withQueryString();

        return view('penggajian.riwayat-pegawai', compact('penggajian'));
    }
}
