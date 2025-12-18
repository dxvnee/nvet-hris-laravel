<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule foto cleanup to run daily at midnight
Schedule::command('photos:cleanup --days=40')
    ->daily()
    ->at('00:00')
    ->description('Hapus foto absensi dan lembur yang lebih dari 40 hari');
