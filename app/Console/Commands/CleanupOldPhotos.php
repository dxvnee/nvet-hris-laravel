<?php

namespace App\Console\Commands;

use App\Services\PhotoService;
use Illuminate\Console\Command;

class CleanupOldPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:cleanup {--days=40 : Number of days to keep photos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete attendance photos older than specified days (default: 40 days)';

    /**
     * Execute the console command.
     */
    public function handle(PhotoService $photoService): int
    {
        $days = (int) $this->option('days');

        $this->info("Cleaning up photos older than {$days} days...");

        $deletedCount = $photoService->deleteOldPhotos($days);

        $this->info("Successfully deleted {$deletedCount} old photos.");

        return Command::SUCCESS;
    }
}
