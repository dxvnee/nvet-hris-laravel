<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY jabatan ENUM('FO', 'Tech', 'Paramedis', 'Dokter', 'Admin')
            NOT NULL DEFAULT 'FO'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY jabatan ENUM('FO', 'Tech', 'Paramedis', 'Dokter')
            NOT NULL DEFAULT 'FO'
        ");
    }
};
