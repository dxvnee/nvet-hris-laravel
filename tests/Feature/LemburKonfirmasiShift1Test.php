<?php

namespace Tests\Feature;

use App\Models\Absen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LemburKonfirmasiShift1Test extends TestCase
{
    use DatabaseTransactions;

    /**
     * Skenario UTAMA: Dokter shift 1 harus mendapat notifikasi konfirmasi lembur
     * ketika lanjut kerja melewati shift1_jam_keluar (14:00) karena shift 2 libur.
     *
     * Waktu: 15:00 — sudah lewat shift1_jam_keluar (14:00) tapi BELUM lewat jam_keluar (20:00)
     * BUG SEBELUMNYA: bisaLemburTelat menggunakan jam_keluar (20:00) bukan shift1_jam_keluar (14:00)
     */
    public function test_dokter_shift1_mendapat_konfirmasi_lembur_saat_shift2_libur(): void
    {
        // Jam 15:00 — sudah lewat shift1_jam_keluar (14:00) tapi belum jam_keluar (20:00)
        $today = Carbon::create(2026, 3, 18, 15, 0, 0);
        Carbon::setTestNow($today);

        // Buat Dokter A (shift 1) - jam keluar 20:00
        $dokterA = User::factory()->create([
            'name' => 'Dokter A',
            'jabatan' => 'Dokter',
            'role' => 'pegawai',
            'is_shift' => true,
            'jam_masuk' => '08:00',
            'jam_keluar' => '20:00',
            'shift1_jam_masuk' => '08:00',
            'shift1_jam_keluar' => '14:00',
            'shift2_jam_masuk' => '14:00',
            'shift2_jam_keluar' => '20:00',
            'hari_libur' => [], // Tidak libur hari ini
        ]);

        // Buat Dokter B (shift 2 / partner) - libur hari Rabu (isoWeekday 3)
        $dokterB = User::factory()->create([
            'name' => 'Dokter B',
            'jabatan' => 'Dokter',
            'role' => 'pegawai',
            'is_shift' => true,
            'jam_masuk' => '08:00',
            'jam_keluar' => '20:00',
            'shift1_jam_masuk' => '08:00',
            'shift1_jam_keluar' => '14:00',
            'shift2_jam_masuk' => '14:00',
            'shift2_jam_keluar' => '20:00',
            'hari_libur' => [3], // Libur hari Rabu (isoWeekday 3)
        ]);

        // Set shift partner (saling pasangan)
        $dokterA->update(['shift_partner_id' => $dokterB->id]);
        $dokterB->update(['shift_partner_id' => $dokterA->id]);

        // Dokter A sudah absen masuk hari ini sebagai shift 1
        $absenDokterA = Absen::create([
            'user_id' => $dokterA->id,
            'tanggal' => $today->toDateString(),
            'jam_masuk' => Carbon::create(2026, 3, 18, 8, 0, 0),
            'telat' => false,
            'menit_telat' => 0,
            'izin' => false,
            'tidak_hadir' => false,
            'libur' => false,
            'shift_number' => 1,
        ]);

        // Dokter B libur (auto-created absen with libur=true)
        Absen::create([
            'user_id' => $dokterB->id,
            'tanggal' => $today->toDateString(),
            'libur' => true,
            'izin' => false,
            'telat' => false,
            'tidak_hadir' => false,
        ]);

        // Akses halaman absen sebagai Dokter A
        $response = $this->actingAs($dokterA)->get(route('absen.index'));

        $response->assertStatus(200);

        // Pastikan Dokter A TIDAK dianggap libur
        $response->assertViewHas('liburOrNot', false);

        // Pastikan Dokter A sudah hadir (sudahHadir bukan null)
        $response->assertViewHas('sudahHadir', function ($value) {
            return $value !== null && $value->jam_masuk !== null;
        });

        // Pastikan belum pulang
        $response->assertViewHas('sudahPulang', null);

        // Pastikan belum izin
        $response->assertViewHas('sudahIzin', null);

        // Pastikan bisaLemburTelat = true (waktu sudah lewat shift1_jam_keluar 14:00)
        $response->assertViewHas('bisaLemburTelat', true);

        // Pastikan jamPulangSetting menggunakan shift1_jam_keluar (14:00) bukan jam_keluar (20:00)
        $response->assertViewHas('jamPulangSetting', function ($value) {
            return $value->hour === 14 && $value->minute === 0;
        });

        // Pastikan halaman mengandung elemen konfirmasi lembur
        $response->assertSee('Konfirmasi Lembur');
    }

    /**
     * Tes bahwa Dokter shift 1 TIDAK mendapat konfirmasi lembur
     * jika belum lewat shift1_jam_keluar.
     */
    public function test_dokter_shift1_tidak_mendapat_konfirmasi_lembur_sebelum_jam_pulang_shift1(): void
    {
        // Hari ini Rabu jam 13:00 - belum lewat jam pulang
        $today = Carbon::create(2026, 3, 18, 13, 0, 0);
        Carbon::setTestNow($today);

        $dokterA = User::factory()->create([
            'name' => 'Dokter A',
            'jabatan' => 'Dokter',
            'role' => 'pegawai',
            'is_shift' => true,
            'jam_masuk' => '08:00',
            'jam_keluar' => '20:00',
            'shift1_jam_masuk' => '08:00',
            'shift1_jam_keluar' => '14:00',
            'shift2_jam_masuk' => '14:00',
            'shift2_jam_keluar' => '20:00',
            'hari_libur' => [],
        ]);

        $dokterB = User::factory()->create([
            'name' => 'Dokter B',
            'jabatan' => 'Dokter',
            'role' => 'pegawai',
            'is_shift' => true,
            'jam_masuk' => '08:00',
            'jam_keluar' => '20:00',
            'shift1_jam_masuk' => '08:00',
            'shift1_jam_keluar' => '14:00',
            'shift2_jam_masuk' => '14:00',
            'shift2_jam_keluar' => '20:00',
            'hari_libur' => [3], // Libur Rabu
        ]);

        $dokterA->update(['shift_partner_id' => $dokterB->id]);
        $dokterB->update(['shift_partner_id' => $dokterA->id]);

        Absen::create([
            'user_id' => $dokterA->id,
            'tanggal' => $today->toDateString(),
            'jam_masuk' => Carbon::create(2026, 3, 18, 8, 0, 0),
            'telat' => false,
            'menit_telat' => 0,
            'izin' => false,
            'tidak_hadir' => false,
            'libur' => false,
            'shift_number' => 1,
        ]);

        $response = $this->actingAs($dokterA)->get(route('absen.index'));

        $response->assertStatus(200);
        $response->assertViewHas('liburOrNot', false);

        // bisaLemburTelat harus false karena belum lewat jam pulang
        $response->assertViewHas('bisaLemburTelat', false);
    }

    /**
     * Tes bahwa ketika shift 2 libur dan Dokter shift 1 pulang setelah shift1_jam_keluar,
     * request POST pulang dengan is_lembur=1 berhasil membuat record Lembur.
     */
    public function test_dokter_shift1_bisa_submit_lembur_saat_pulang_ketika_shift2_libur(): void
    {
        // Jam 15:30 - lewat shift1_jam_keluar (14:00) tapi belum jam_keluar (20:00)
        $today = Carbon::create(2026, 3, 18, 15, 30, 0);
        Carbon::setTestNow($today);

        $dokterA = User::factory()->create([
            'name' => 'Dokter A',
            'jabatan' => 'Dokter',
            'role' => 'pegawai',
            'is_shift' => true,
            'jam_masuk' => '08:00',
            'jam_keluar' => '20:00',
            'shift1_jam_masuk' => '08:00',
            'shift1_jam_keluar' => '14:00',
            'shift2_jam_masuk' => '14:00',
            'shift2_jam_keluar' => '20:00',
            'hari_libur' => [],
        ]);

        $dokterB = User::factory()->create([
            'name' => 'Dokter B',
            'jabatan' => 'Dokter',
            'role' => 'pegawai',
            'is_shift' => true,
            'jam_masuk' => '08:00',
            'jam_keluar' => '20:00',
            'shift1_jam_masuk' => '08:00',
            'shift1_jam_keluar' => '14:00',
            'shift2_jam_masuk' => '14:00',
            'shift2_jam_keluar' => '20:00',
            'hari_libur' => [3],
        ]);

        $dokterA->update(['shift_partner_id' => $dokterB->id]);
        $dokterB->update(['shift_partner_id' => $dokterA->id]);

        Absen::create([
            'user_id' => $dokterA->id,
            'tanggal' => $today->toDateString(),
            'jam_masuk' => Carbon::create(2026, 3, 18, 8, 0, 0),
            'telat' => false,
            'menit_telat' => 0,
            'izin' => false,
            'tidak_hadir' => false,
            'libur' => false,
            'shift_number' => 1,
        ]);

        // Foto dummy base64 (1x1 pixel JPEG)
        $dummyPhoto = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAEDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAFRABAQAAAAAAAAAAAAAAAAAAAAf/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AiwA//9k=';

        // Submit pulang dengan lembur
        $response = $this->actingAs($dokterA)->post(route('absen.store'), [
            'tipe' => 'pulang',
            'foto' => $dummyPhoto,
            'latitude' => -6.189035762950233,
            'longitude' => 106.61662426529043,
            'is_lembur' => '1',
            'lembur_keterangan' => 'Lembur karena shift 2 libur',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Pastikan record Lembur dibuat
        $this->assertDatabaseHas('lemburs', [
            'user_id' => $dokterA->id,
            'tanggal' => $today->toDateString(),
            'status' => 'pending',
            'keterangan' => 'Lembur karena shift 2 libur',
        ]);

        // Pastikan absen sudah update jam_pulang
        $this->assertDatabaseHas('absens', [
            'user_id' => $dokterA->id,
            'tanggal' => $today->toDateString(),
            'shift_number' => 1,
        ]);

        $absen = Absen::where('user_id', $dokterA->id)
            ->whereDate('tanggal', $today->toDateString())
            ->first();

        $this->assertNotNull($absen->jam_pulang);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow(); // Reset test time
        parent::tearDown();
    }
}
