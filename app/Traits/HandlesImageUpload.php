<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HandlesImageUpload
{
    /**
     * Upload an image to public/uploads/{folder} and return relative path
     */
    protected function uploadImage(UploadedFile $file, string $folder = 'general'): string
    {
        $destinationPath = public_path("uploads/{$folder}");
        
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Never use the client-supplied filename extension for a public upload.
        $extension = match ($file->getMimeType()) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            default => null,
        };

        abort_unless($extension, 422, 'Jenis gambar tidak didukung.');

        $filename = Str::random(40) . '.' . $extension;
        $file->move($destinationPath, $filename);

        return "uploads/{$folder}/{$filename}";
    }

    /**
     * Delete an uploaded file if exists
     */
    protected function deleteUploadedImage(?string $path): void
    {
        if ($path && ! Str::startsWith($path, ['http://', 'https://'])) {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }
    }
}
