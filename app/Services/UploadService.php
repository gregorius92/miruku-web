<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UploadService
{
    /**
     * Upload and compress an image to Supabase storage.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int $quality Compression quality (0-100)
     * @param int|null $maxWidth Maximum width for the image
     * @return string The path of the uploaded file
     */
    public static function upload(UploadedFile $file, string $directory, int $quality = 80, int $maxWidth = 1920): string
    {
        // Generate a unique filename
        $extension = $file->getClientOriginalExtension();
        if (empty($extension)) {
            $extension = 'jpg';
        }
        $filename = Str::random(40) . '.' . $extension;
        $path = $directory . '/' . $filename;

        // Check if the file is an image that can be processed
        if (self::isImage($file)) {
            $image = Image::make($file);

            // Fix orientation based on EXIF data
            $image->orientate();

            // Resize if exceeds max width
            if ($maxWidth && $image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            // Encode with quality compression
            $encoded = $image->encode($extension, $quality);

            // Upload to Supabase
            Storage::disk('supabase')->put($path, (string) $encoded);
        } else {
            // Non-image files are uploaded directly
            Storage::disk('supabase')->putFileAs($directory, $file, $filename);
        }

        return $path;
    }

    /**
     * Check if the file is an image.
     */
    private static function isImage(UploadedFile $file): bool
    {
        $mime = $file->getMimeType();
        return str_starts_with($mime, 'image/');
    }
}
