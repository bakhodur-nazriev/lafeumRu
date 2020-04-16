<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Author;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    public function index()
    {
        $quotes = Quote::with("author", "categories")->paginate(10);
        $categories = Category::where('type', Quote::class)->get()->toTree()->unique("name");
        return view("/quotes", compact(["quotes", "categories"]));
    }

    public function get(Request $request)
    {
        $quotesQuery = Quote::with('author', 'categories');
        return $quotesQuery->latest()->get();
    }

    public function store(Request $request)
    {
        return Quote::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $quote->update($request->all());
        $quote->save();
        return response()->json($quote);
    }

    public function delete($id)
    {
        Quote::destroy($id);
        return response()->json("ok");
    }
}
