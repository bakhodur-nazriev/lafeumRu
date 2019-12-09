<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('id')->paginate(12);
        return view('/photos', compact('photos'));
    }
}
