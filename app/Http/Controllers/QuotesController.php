<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Tag;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function index()
    {
        $quotes = Quote::with(Tag::class, 'tags')->get();
        return $quotes;
        // foreach ($quotes->tags as $tag) {
        //     return $tag;
        // }
        // return $quotes;

        return view('/quotes', compact('quotes'));
    }
}
