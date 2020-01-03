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

    public function get()
    {
        $quotes = Quote::with(['author', 'tags'])->get();
        return response()->json($quotes);
    }

    public function store(Request $request)
    {
        $quote = Quote::create($request->all());
        return response()->json($quote);
    }

    public function delete($id)
    {
        Quote::destroy($id);
        return response()->json("ok");
    }
}
