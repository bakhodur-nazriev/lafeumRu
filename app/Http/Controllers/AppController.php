<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use App\Quote;
use App\Term;
use App\Photo;
use App\Video;

class AppController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $photos = Photo::take(3)->get();
        $categories = Category::get()->toTree()->unique('name');
        return view('/home', compact(['photos', 'categories',]));
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
