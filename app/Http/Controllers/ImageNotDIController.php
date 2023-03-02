<?php

namespace App\Http\Controllers;

use App\Util\ImageGCPStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageNotDIController extends Controller
{
    public function index(): View
    {
        return view('imagenotdi.index');
    }

    public function save(Request $request): RedirectResponse
    {
        $storage = $request->get('storage');

        //local storage
        if ($storage == 'local') {
            $storeImageLocal = new ImageLocalStorage();
            $storeImageLocal->store($request);
        }
        //gcp storage
        elseif ($storage == 'gcp') {
            $storeImageGCP = new ImageGCPStorage();
            $storeImageGCP->store($request);
        }

        return back();
    }
}
