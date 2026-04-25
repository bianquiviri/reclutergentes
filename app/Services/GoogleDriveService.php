<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class GoogleDriveService
{
    /**
     * Upload an encrypted file to Google Drive.
     */
    public function uploadEncrypted($file, $path)
    {
        try {
            $contents = file_get_contents($file->getRealPath());
            $encryptedContents = Crypt::encrypt($contents);
            
            return Storage::disk('google')->put($path, $encryptedContents);
        } catch (\Exception $e) {
            Log::error("Error uploading encrypted file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Download and decrypt a file from Google Drive.
     */
    public function downloadDecrypted($path)
    {
        try {
            $encryptedContents = Storage::disk('google')->get($path);
            return Crypt::decrypt($encryptedContents);
        } catch (\Exception $e) {
            Log::error("Error downloading/decrypting file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Stream an encrypted file as decrypted.
     */
    public function streamDecrypted($path, $filename)
    {
        $decryptedContents = $this->downloadDecrypted($path);
        
        if (!$decryptedContents) {
            abort(404);
        }

        return response()->streamDownload(function () use ($decryptedContents) {
            echo $decryptedContents;
        }, $filename);
    }
}
