<?php

namespace App\Http\Controllers;

use App\Photos;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photos::all();
        // return($photos);
        return view('/photos', compact('photos'));
    }
}
