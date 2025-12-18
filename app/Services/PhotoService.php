<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PhotoService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Process uploaded photo: compress and add timestamp
     *
     * @param string $base64Image Base64 encoded image data
     * @param string $type Type of photo (masuk, pulang, izin, lembur_mulai, lembur_selesai)
     * @param int $userId User ID
     * @return string|null Path to saved file
     */
    public function processPhoto(string $base64Image, string $type, int $userId): ?string
    {
        try {
            // Remove data URL prefix if present
            if (str_contains($base64Image, ',')) {
                $base64Image = explode(',', $base64Image)[1];
            }

            // Decode base64
            $imageData = base64_decode($base64Image);
            if (!$imageData) {
                return null;
            }

            // Create image instance
            $image = $this->manager->read($imageData);

            // Resize to max 800px width while maintaining aspect ratio
            $image->scale(width: 800);

            // Add timestamp watermark
            $timestamp = Carbon::now()->format('d M Y H:i:s');
            $text = $timestamp . ' WIB';

            // Add text watermark at bottom
            $image->text($text, $image->width() - 10, $image->height() - 10, function ($font) {
                $font->filename(public_path('fonts/arial.ttf'));
                $font->size(16);
                $font->color('#ffffff');
                $font->align('right');
                $font->valign('bottom');
                $font->stroke('#000000', 2);
            });

            // Generate filename
            $filename = sprintf(
                'absensi/%s/%s_%s_%s.jpg',
                Carbon::now()->format('Y/m'),
                $type,
                $userId,
                Carbon::now()->format('YmdHis')
            );

            // Encode as JPEG with 70% quality for compression
            $encoded = $image->toJpeg(70);

            // Save to storage
            Storage::disk('public')->put($filename, (string) $encoded);

            return $filename;
        } catch (\Exception $e) {
            \Log::error('Photo processing error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete old photos (older than specified days)
     *
     * @param int $days Number of days to keep photos
     * @return int Number of deleted files
     */
    public function deleteOldPhotos(int $days = 40): int
    {
        $deletedCount = 0;
        $cutoffDate = Carbon::now()->subDays($days);

        // Get all files in absensi directory
        $directories = Storage::disk('public')->directories('absensi');

        foreach ($directories as $yearDir) {
            $monthDirs = Storage::disk('public')->directories($yearDir);

            foreach ($monthDirs as $monthDir) {
                $files = Storage::disk('public')->files($monthDir);

                foreach ($files as $file) {
                    $lastModified = Storage::disk('public')->lastModified($file);
                    $fileDate = Carbon::createFromTimestamp($lastModified);

                    if ($fileDate->lt($cutoffDate)) {
                        Storage::disk('public')->delete($file);
                        $deletedCount++;
                    }
                }

                // Delete empty directories
                if (
                    empty(Storage::disk('public')->files($monthDir)) &&
                    empty(Storage::disk('public')->directories($monthDir))
                ) {
                    Storage::disk('public')->deleteDirectory($monthDir);
                }
            }

            // Delete empty year directories
            if (
                empty(Storage::disk('public')->files($yearDir)) &&
                empty(Storage::disk('public')->directories($yearDir))
            ) {
                Storage::disk('public')->deleteDirectory($yearDir);
            }
        }

        return $deletedCount;
    }
}
