# NVet Management (HRIS)

Aplikasi HRIS berbasis Laravel untuk manajemen operasional klinik/hewan (NVet), mencakup:

- Absensi harian pegawai (masuk, pulang, izin, lokasi, foto)
- Kalender absensi admin dan riwayat absensi pegawai
- Pengajuan & approval lembur
- Penggajian bulanan (potongan telat/alpha, insentif jabatan, lembur, item lain-lain)
- Manajemen pegawai (shift/non-shift, hari libur, status inactive)
- Manajemen hari libur & hari khusus

---

## 1. Teknologi

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Blade, Vite, Tailwind CSS, Alpine.js
- **Database**: MySQL/MariaDB (default Laravel), bisa disesuaikan via `.env`
- **Image Processing**: `intervention/image`
- **Auth**: Laravel Breeze (login/logout)

---

## 2. Peran Pengguna

### Admin
- Dashboard admin dengan statistik absensi & payroll
- Kelola pegawai (`users`)
- Kelola penggajian (`penggajian`)
- Kelola hari libur/hari khusus (`hari-libur`)
- Review lembur (`lembur-admin`) dan approve/reject
- Kelola absensi manual dari kalender admin

### Pegawai
- Dashboard pegawai
- Absen harian (`/absen`)
- Riwayat absensi tabel & kalender
- Pengajuan lembur dan penyelesaian lembur
- Riwayat penggajian final
- Kelola profil & password

---

## 3. Fitur Utama

## 3.1 Absensi
- Absensi berdasarkan lokasi kantor dengan radius validasi.
- Wajib foto untuk aksi absen/izin (diproses & dikompresi oleh `PhotoService`).
- Satu record absen per pegawai per hari.
- Mendukung:
	- hadir masuk/pulang,
	- izin tidak masuk,
	- izin pulang awal,
	- pencatatan dari luar lokasi dengan alasan,
	- shift 1 / shift 2.
- Admin dapat tambah/edit/hapus absensi manual dari kalender admin.

## 3.2 Hari Libur & Hari Khusus
- Hari libur reguler dan hari berulang tahunan (`is_recurring`).
- Hari khusus dapat diatur:
	- apakah masuk (`is_masuk`),
	- apakah dianggap lembur (`is_lembur`),
	- jam kerja custom,
	- mode shift custom,
	- pegawai tertentu yang wajib hadir,
	- `upah_multiplier`.
- Logika `shouldUserWork()` menentukan apakah pegawai wajib kerja pada tanggal tertentu.

## 3.3 Lembur
- Pegawai memulai lembur (wajib foto) setelah jam pulang.
- Pegawai menyelesaikan lembur (wajib foto + keterangan), sistem menghitung durasi menit.
- Status lembur: `pending`, `approved`, `rejected`.
- Admin memproses approval/rejection (dengan alasan penolakan).

## 3.4 Penggajian
- Payroll per periode (`YYYY-MM`) dan per pegawai (unik).
- Komponen gaji:
	- gaji pokok,
	- potongan telat,
	- potongan tidak hadir,
	- potongan lupa pulang,
	- insentif berbasis jabatan,
	- upah lembur dari data lembur approved,
	- item lain-lain (`lain_lain_items`, bisa plus/minus).
- Status payroll: `draft` / `final`.
- Slip gaji dapat dicetak oleh admin atau pegawai pemilik data.

## 3.5 Manajemen Pegawai
- CRUD pegawai (non-admin).
- Setup jadwal kerja:
	- **Non-shift**: `jam_masuk` / `jam_keluar`
	- **Shift**: pasangan shift + jam shift 1 & shift 2
- Hari libur mingguan per user (`hari_libur`).
- Status **inactive**:
	- permanen,
	- sementara dengan rentang tanggal + alasan.

## 3.6 Profil
- Ubah profil pengguna.
- Upload avatar (crop square + resize + kompres).
- Ubah password.
- Hapus akun sendiri.

---

## 4. Otomasi Terjadwal (Scheduler)

Terdaftar di `routes/console.php`:

1. `photos:cleanup --days=40`
	 - Jalan tiap hari pukul **00:00**
	 - Menghapus foto absensi/lembur lama dari storage publik

2. `absensi:check-status`
	 - Jalan tiap hari pukul **06:00**
	 - Menandai data absensi untuk hari sebelumnya:
		 - `libur` jika hari libur,
		 - `tidak_hadir` jika tidak ada absensi,
		 - auto checkout `lupa_pulang` jika lupa absen pulang.

Pastikan cron scheduler Laravel aktif di server production.

Contoh cron:

```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 5. Instalasi & Menjalankan Lokal

## 5.1 Prasyarat
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL/MariaDB (atau DB lain yang didukung Laravel)

## 5.2 Setup cepat

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Atur koneksi database di `.env`, lalu:

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
npm install
```

Jalankan mode development (server + queue + logs + vite via script composer):

```bash
composer run dev
```

Atau manual terpisah:

```bash
php artisan serve
php artisan queue:listen --tries=1
npm run dev
```

---

## 6. Akun Default Seeder

Hasil dari `DatabaseSeeder`:

- **Admin**: `admin@nvet.com`
- **Pegawai**: `pegawai@nvet.com`
- **Password default factory**: `password`

---

## 7. Struktur Modul (Ringkas)

- `app/Http/Controllers/AbsenController.php` → absensi pegawai & admin
- `app/Http/Controllers/PenggajianController.php` → payroll + slip
- `app/Http/Controllers/LemburController.php` → lembur pegawai/admin
- `app/Http/Controllers/UserController.php` → manajemen pegawai
- `app/Http/Controllers/HariLiburController.php` → hari libur/hari khusus
- `app/Http/Controllers/ProfileController.php` → profil & password
- `app/Models/*` → model domain utama (`User`, `Absen`, `HariLibur`, `Lembur`, `Penggajian`)
- `app/Services/PhotoService.php` → proses & cleanup foto
- `app/Console/Commands/*` → command otomatis absensi/foto

---

## 8. Route Penting

- Auth: `/login`, `POST /logout`
- Dashboard redirect role: `/dashboard`
- Dashboard admin: `/dashboard/admin`
- Dashboard pegawai: `/dashboard/pegawai`

### Pegawai
- `/absen`, `/riwayat`, `/riwayat-kalender`
- `/lembur`
- `/penggajian-riwayat`

### Admin
- Resource `users`
- Resource `penggajian`
- `hari-libur`
- `/lembur-admin`
- `/absensi-kalender` + detail per tanggal
- CRUD absensi manual (`/absen/create/...`, `/absen/manual`, `/absen/{absen}`)

---

## 9. Catatan Implementasi

- Middleware role menggunakan alias `role` (lihat `bootstrap/app.php`).
- Error 403 diarahkan ke login dengan pesan akses.
- Koordinat kantor dan radius absensi saat ini hardcoded di `AbsenController`.
- Foto absensi/lembur disimpan di disk `public` dengan struktur folder per tahun/bulan.

---

## 10. Testing

Menjalankan test:

```bash
composer test
```

Atau:

```bash
php artisan test
```
