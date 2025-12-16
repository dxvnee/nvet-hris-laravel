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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('periode'); // Format: YYYY-MM (contoh: 2025-12)
            $table->decimal('gaji_pokok', 12, 2);

            // Potongan keterlambatan
            $table->integer('total_menit_telat')->default(0);
            $table->decimal('potongan_per_menit', 10, 2)->default(500); // Default Rp 500/menit
            $table->decimal('total_potongan_telat', 12, 2)->default(0);

            // Insentif berdasarkan jabatan (disimpan sebagai JSON)
            $table->json('insentif_detail')->nullable();
            $table->decimal('total_insentif', 12, 2)->default(0);

            // Reimburse
            $table->decimal('reimburse', 12, 2)->default(0);
            $table->text('keterangan_reimburse')->nullable();

            // Lain-lain
            $table->decimal('lain_lain', 12, 2)->default(0);
            $table->text('keterangan_lain')->nullable();

            // Total
            $table->decimal('total_gaji', 12, 2);

            $table->text('catatan')->nullable();
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->timestamps();

            $table->unique(['user_id', 'periode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
