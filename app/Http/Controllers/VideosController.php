<?php

namespace App\Http\Controllers;

use App\Channels;
use Illuminate\Http\Request;

use App\Videos;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Videos::all();

        return view('/videos', compact('videos'));
    }
}
