<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Spatie\Browsershot\Browsershot;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const IMAGES_PATH = "/img/";
    const META_IMAGES_PATH = "/img/meta/";

    protected function saveImage($name, $file, $pathFromPublic = self::IMAGES_PATH)
    {
        $extension = $file->extension();
        $filename = $name . "." . $extension;
        $file->move(public_path($pathFromPublic), $filename);
        return $pathFromPublic . $filename;
    }

    protected function generateMetaImage($html, $pathWithFile)
    {
        Browsershot::html($html)
            ->setNodeModulePath(env('NODE_MODULES_PATH'))
            ->setChromePath(env('CHROME_PATH'))
            ->waitUntilNetworkIdle()
            ->windowSize(1200, 628)
            ->save($pathWithFile);
    }
}
