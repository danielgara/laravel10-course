<?php

namespace App\Http\Controllers;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImageBasicController extends Controller
{
    public function index(): View
    {
        return view('imagebasic.index');
    }

    public function save(Request $request): RedirectResponse
    {
        $storage = $request->input('storage');

        if ($request->hasFile('profile_image')) {
            //local storage
            if ($storage == 'local') {
                Storage::disk('public')->put('test.png',
                    file_get_contents($request->file('profile_image')->getRealPath()));
            }
            //gcp storage
            elseif ($storage == 'gcp') {
                $gcpKeyFile = file_get_contents(env('GCP_KEY_FILE'));
                $storage = new StorageClient(['keyFile' => json_decode($gcpKeyFile, true)]);
                $bucket = $storage->bucket(env('GCP_BUCKET'));
                $gcpStoragePath = 'images/test.png';
                $bucket->upload(file_get_contents($request->file('profile_image')->getRealPath()), [
                    'name' => $gcpStoragePath,
                ]);
            }

            return back();
        }
    }
}
