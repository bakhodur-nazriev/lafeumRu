<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('/vocabulary', compact('categories'));
    }
}
