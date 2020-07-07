<?php

namespace App\Http\Controllers;

use App\Category;

class AppController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = Category::get()->toTree()->unique('name');
        return view('/home', compact(['categories']));
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
