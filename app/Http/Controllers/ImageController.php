<?php

namespace App\Http\Controllers;

use App\Interfaces\ImageStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageController extends Controller
{
    public function index(): View
    {
        return view('image.index');
    }

    public function save(Request $request): RedirectResponse
    {
        $storage = $request->get('storage');
        $storeInterface = app(ImageStorage::class,
            ['storage' => $storage]);
        $storeInterface->store($request);

        return back();
    }
}
