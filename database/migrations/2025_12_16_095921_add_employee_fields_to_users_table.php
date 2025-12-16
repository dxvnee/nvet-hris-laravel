<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('gaji_pokok', 12, 2)->nullable()->after('avatar');
            $table->integer('jam_kerja')->nullable()->after('gaji_pokok'); // jam kerja per hari
            $table->json('hari_libur')->nullable()->after('jam_kerja'); // array hari libur (0=Minggu, 1=Senin, dst)
            $table->enum('role', ['admin', 'pegawai'])->default('pegawai')->after('hari_libur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gaji_pokok', 'jam_kerja', 'hari_libur', 'role']);
        });
    }
};
