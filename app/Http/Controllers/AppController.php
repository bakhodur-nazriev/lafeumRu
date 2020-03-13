<?php

namespace App\Http\Controllers;

use App\Category;
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
        $categories = Category::get()->toTree()->unique('name');
        return view('/home', compact(['channels', 'photos', 'categories']));
    }
}
