<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const IMAGES_PATH = "/img/";

    protected function saveImage($name, $file, $pathFromPublic = self::IMAGES_PATH)

    {
        $extension = $file->extension();
        $filename = $name . "." . $extension;
        $file->move(public_path($pathFromPublic), $filename);
        return self::PHOTOS_PATH . $filename;
    }
}
