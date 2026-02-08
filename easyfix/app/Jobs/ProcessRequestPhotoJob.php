<?php

namespace App\Jobs;

use App\Models\RequestPhoto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManagerStatic;

class ProcessRequestPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 120;

    public function __construct(
        public int $requestPhotoId,
        public string $tempPath,
        public string $originalName
    ) {
    }

    public function handle(): void
    {
        $photo = RequestPhoto::find($this->requestPhotoId);

        if (!$photo) {
            return;
        }

        $disk = Storage::disk('local');

        if (!$disk->exists($this->tempPath)) {
            $photo->update(['status' => 'failed']);
            return;
        }

        try {
            $contents = $disk->get($this->tempPath);

            [$image, $driver] = $this->makeImage($contents);

            if (!$image) {
                $photo->update(['status' => 'failed']);
                Log::error('Photo processing failed: Intervention Image not installed');
                return;
            }

            $this->stripMetadata($image, $driver);
            $this->resizeImage($image, 2048, $driver);

            $thumb = $this->cloneImage($image, $driver);
            $this->resizeImage($thumb, 800, $driver);

            $uuid = (string) Str::uuid();
            $photoKey = 'requests/' . $photo->job_request_id . '/photos/' . $uuid;
            $thumbKey = 'requests/' . $photo->job_request_id . '/thumbs/' . $uuid;

            [$mainBinary, $mainMime, $mainExt] = $this->encodePreferred($image, $driver);
            [$thumbBinary, $thumbMime, $thumbExt] = $this->encodePreferred($thumb, $driver);

            $photoPath = $photoKey . '.' . $mainExt;
            $thumbPath = $thumbKey . '.' . $thumbExt;

            $targetDisk = config('filesystems.disks.spaces.key') ? 'spaces' : 'public';

            Storage::disk($targetDisk)->put($photoPath, $mainBinary, 'private');
            Storage::disk($targetDisk)->put($thumbPath, $thumbBinary, 'private');

            $photo->update([
                'disk' => $targetDisk,
                'photo_path' => $photoPath,
                'thumb_path' => $thumbPath,
                'mime' => $mainMime,
                'size_bytes' => strlen($mainBinary),
                'width' => $this->getWidth($image, $driver),
                'height' => $this->getHeight($image, $driver),
                'status' => 'ready',
            ]);
        } catch (\Throwable $e) {
            $photo->update(['status' => 'failed']);
            Log::error('Photo processing failed', [
                'request_photo_id' => $photo->id,
                'error' => $e->getMessage(),
            ]);
        } finally {
            $disk->delete($this->tempPath);
        }
    }

    protected function imageManager(): ImageManager
    {
        if (extension_loaded('imagick')) {
            return new ImageManager(new ImagickDriver());
        }

        return new ImageManager(new GdDriver());
    }

    protected function makeImage(string $contents): array
    {
        if (class_exists(ImageManager::class)) {
            $manager = $this->imageManager();
            return [$manager->read($contents), 'v3'];
        }

        if (class_exists(ImageManagerStatic::class)) {
            return [ImageManagerStatic::make($contents), 'v2'];
        }

        return [null, null];
    }

    protected function stripMetadata($image, ?string $driver): void
    {
        if (method_exists($image, 'orient')) {
            $image->orient();
            return;
        }

        if (method_exists($image, 'orientate')) {
            $image->orientate();
        }
    }

    protected function resizeImage($image, int $max, ?string $driver): void
    {
        if ($driver === 'v3' && method_exists($image, 'scaleDown')) {
            $image->scaleDown($max, $max);
            return;
        }

        if (method_exists($image, 'resize')) {
            $image->resize($max, $max, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
    }

    protected function cloneImage($image, ?string $driver)
    {
        if ($driver === 'v3' && method_exists($image, 'clone')) {
            return $image->clone();
        }

        if (method_exists($image, 'clone')) {
            return $image->clone();
        }

        if (method_exists($image, 'backup') && method_exists($image, 'reset')) {
            $image->backup();
            $image->reset();
            return $image;
        }

        return $image;
    }

    protected function getWidth($image, ?string $driver): int
    {
        if (method_exists($image, 'width')) {
            return (int) $image->width();
        }

        if (method_exists($image, 'getWidth')) {
            return (int) $image->getWidth();
        }

        return 0;
    }

    protected function getHeight($image, ?string $driver): int
    {
        if (method_exists($image, 'height')) {
            return (int) $image->height();
        }

        if (method_exists($image, 'getHeight')) {
            return (int) $image->getHeight();
        }

        return 0;
    }

    protected function encodePreferred($image, ?string $driver): array
    {
        if ($driver === 'v3') {
            try {
                $encoded = $image->toWebp(80);
                return [(string) $encoded, 'image/webp', 'webp'];
            } catch (\Throwable $e) {
                $encoded = $image->toJpeg(80);
                return [(string) $encoded, 'image/jpeg', 'jpg'];
            }
        }

        try {
            $encoded = $image->encode('webp', 80);
            return [(string) $encoded, 'image/webp', 'webp'];
        } catch (\Throwable $e) {
            $encoded = $image->encode('jpg', 80);
            return [(string) $encoded, 'image/jpeg', 'jpg'];
        }
    }
}
