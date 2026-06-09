<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    public function uploadFile($files, $dir = 'uploads')
    {
        $driver = env('FILE_UPLOAD_DRIVER', 'storage');

        $dir = trim($dir, '/');
        $files = is_array($files) ? $files : [$files];
        $urls = [];
        // dd($driver);
        foreach ($files as $file) {

            if (!$file || !$file->isValid()) {
                continue;
            }

            $hash = hash('sha256', Str::uuid() . microtime(true));
            $filename = $hash . '.' . $file->getClientOriginalExtension();

            // ==============================
            // STORAGE MODE (SYMLINK)
            // ==============================
            if ($driver === 'storage') {

                if (!Storage::disk('public')->exists($dir)) {
                    Storage::disk('public')->makeDirectory($dir);
                }

                $path = $file->storeAs($dir, $filename, 'public');

                $urls[] = Storage::disk('public')->url($path);
            }

            // ==============================
            // PUBLIC MODE (NO SYMLINK)
            // ==============================
            else {

                $publicPath = public_path($dir);

                if (!file_exists($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }

                $file->move($publicPath, $filename);

                $urls[] = asset($dir . '/' . $filename);
            }
        }

        return $urls;
    }
}
