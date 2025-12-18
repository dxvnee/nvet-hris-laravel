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
        Schema::table('absens', function (Blueprint $table) {
            $table->string('foto_masuk')->nullable()->after('lng_masuk');
            $table->string('foto_pulang')->nullable()->after('lng_pulang');
            $table->string('foto_izin')->nullable()->after('izin_keterangan');
        });

        Schema::table('lemburs', function (Blueprint $table) {
            $table->string('foto_mulai')->nullable()->after('jam_mulai');
            $table->string('foto_selesai')->nullable()->after('jam_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absens', function (Blueprint $table) {
            $table->dropColumn(['foto_masuk', 'foto_pulang', 'foto_izin']);
        });

        Schema::table('lemburs', function (Blueprint $table) {
            $table->dropColumn(['foto_mulai', 'foto_selesai']);
        });
    }
};
