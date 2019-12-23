<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Photo;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $channels = Channel::all();
        $photos = Photo::take(3)->get();
        return view('/home', compact('channels', 'photos'));
    }

    // public function show(Request $request)
    // {
    //     $user = User::find($request->id);
    //     return view('home', compact('user'));
    // }
}
