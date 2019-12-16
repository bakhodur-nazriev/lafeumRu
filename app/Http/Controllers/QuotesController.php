<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Tag;
use App\Author;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function index()
    {
        $quotes = Quote::with(['author', 'tags'])->paginate(8);
        return view('/quotes', compact('quotes'));
    }
}
