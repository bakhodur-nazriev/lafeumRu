<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Tag;
use App\Author;
use http\Env\Response;
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
        return Quote::with('author')->latest()->get();
    }

    public function store(Request $request)
    {
        return Quote::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        return $quote->update($request->all());
        // return response()->json($quote);
    }

    public function delete($id)
    {
        Quote::destroy($id);
        return response()->json("ok");
    }
}
