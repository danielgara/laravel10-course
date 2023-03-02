<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\Request;

class ImageGCPStorage implements ImageStorage
{
    public function store(Request $request): void
    {
        if ($request->hasFile('profile_image')) {
            $gcpKeyFile = file_get_contents(env('GCP_KEY_FILE'));
            $storage = new StorageClient(['keyFile' => json_decode($gcpKeyFile, true)]);
            $bucket = $storage->bucket(env('GCP_BUCKET'));
            $gcpStoragePath = 'images/test.png';
            $bucket->upload(
                file_get_contents($request->file('profile_image')->getRealPath()), [
                    'name' => $gcpStoragePath,
                ]);
        }
    }
}
