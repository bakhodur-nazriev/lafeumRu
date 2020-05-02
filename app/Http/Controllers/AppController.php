<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use App\Quote;
use App\Term;
use App\Photo;

class AppController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $countOfFavoritesQuotes = Quote::get()->count();
        $countOfFavoritesTerms = Term::get()->count();
        $countOfAuthors = Author::get()->count();

        $photos = Photo::take(3)->get();
        $categories = Category::get()->toTree()->unique('name');
        return view('/home', compact([
                'photos',
                'categories',
                'countOfFavoritesQuotes',
                'countOfAuthors',
                'countOfFavoritesTerms'
            ])
        );
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
