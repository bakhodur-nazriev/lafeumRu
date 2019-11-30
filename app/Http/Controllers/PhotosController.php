<?php

namespace App\Http\Controllers;

use App\Photos;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photos::orderBy('id', 'desc')->paginate(9);
        return view('/photos', compact('photos'));
    }
}
