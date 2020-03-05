<?php

namespace App\Http\Controllers;

use App\Category;
use App\Term;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    public function index()
    {
        $vocabularies = Term::latest()->get();
        $categories = Category::get()->toTree()->unique("name");
        return view("/vocabulary", compact(["vocabularies", "categories"]));
    }

    public function show(Term $term)
    {
        return view("shows.showVocabulary", compact("term"));
    }
}
