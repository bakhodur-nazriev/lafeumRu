<?php

namespace App\Http\Controllers;

use App\Authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = Authors::all();
        // return $authors;
        return view('/authors', compact('authors'));
    }
}
