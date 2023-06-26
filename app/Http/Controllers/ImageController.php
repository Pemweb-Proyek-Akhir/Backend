<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage($filename)
    {
        $path = 'public/uploads/' . $filename;
        $file = Storage::get($path);

        return response($file, 200)->header('Content-Type', 'image/jpeg');
    }
}
