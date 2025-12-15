<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('absens', function (Blueprint $table) {

        // Tambah kolom baru
        $table->time('jam_masuk')->nullable()->after('tanggal');
        $table->time('jam_pulang')->nullable()->after('jam_masuk');

        $table->unsignedSmallInteger('menit_telat')->default(0)->after('telat');

        $table->decimal('lat_masuk', 10, 8)->nullable()->after('menit_telat');
        $table->decimal('lng_masuk', 11, 8)->nullable()->after('lat_masuk');
        $table->decimal('lat_pulang', 10, 8)->nullable()->after('lng_masuk');
        $table->decimal('lng_pulang', 11, 8)->nullable()->after('lat_pulang');

        $table->boolean('izin')->default(false)->after('lng_pulang');
        $table->text('izin_keterangan')->nullable()->after('izin');

        $table->unsignedSmallInteger('menit_kerja')->nullable()->after('izin_keterangan');

        // Hapus kolom lama
        $table->dropColumn(['tipe', 'jam', 'latitude', 'longitude', 'keterangan']);

        // Index lama dibuang
        $table->dropIndex(['user_id', 'tanggal', 'tipe']);

        // Unique constraint baru
        $table->unique(['user_id', 'tanggal']);
    });
}

};
