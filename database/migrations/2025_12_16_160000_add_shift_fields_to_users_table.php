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
            // Jam masuk dan keluar normal (non-shift)
            $table->time('jam_masuk')->nullable()->after('jam_kerja');
            $table->time('jam_keluar')->nullable()->after('jam_masuk');

            // Shift settings
            $table->boolean('is_shift')->default(false)->after('jam_keluar');
            $table->foreignId('shift_partner_id')->nullable()->after('is_shift')->constrained('users')->nullOnDelete();

            // Jam shift 1
            $table->time('shift1_jam_masuk')->nullable()->after('shift_partner_id');
            $table->time('shift1_jam_keluar')->nullable()->after('shift1_jam_masuk');

            // Jam shift 2
            $table->time('shift2_jam_masuk')->nullable()->after('shift1_jam_keluar');
            $table->time('shift2_jam_keluar')->nullable()->after('shift2_jam_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['shift_partner_id']);
            $table->dropColumn([
                'jam_masuk',
                'jam_keluar',
                'is_shift',
                'shift_partner_id',
                'shift1_jam_masuk',
                'shift1_jam_keluar',
                'shift2_jam_masuk',
                'shift2_jam_keluar',
            ]);
        });
    }
};
