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
        Schema::table('penggajian', function (Blueprint $table) {
            // Potongan tidak hadir
            $table->integer('total_tidak_hadir')->default(0)->after('total_potongan_telat');
            $table->decimal('potongan_per_tidak_hadir', 12, 2)->default(0)->after('total_tidak_hadir');
            $table->decimal('total_potongan_tidak_hadir', 12, 2)->default(0)->after('potongan_per_tidak_hadir');

            // Potongan lupa pulang
            $table->integer('total_lupa_pulang')->default(0)->after('total_potongan_tidak_hadir');
            $table->decimal('potongan_lupa_pulang', 12, 2)->default(0)->after('total_lupa_pulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penggajian', function (Blueprint $table) {
            $table->dropColumn([
                'total_tidak_hadir',
                'potongan_per_tidak_hadir',
                'total_potongan_tidak_hadir',
                'total_lupa_pulang',
                'potongan_lupa_pulang',
            ]);
        });
    }
};
