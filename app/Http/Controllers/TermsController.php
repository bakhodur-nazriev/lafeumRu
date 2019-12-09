<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Term::all();
        return view('/terms', compact('terms'));
    }
}
