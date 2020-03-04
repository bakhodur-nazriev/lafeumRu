<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Tag;
use App\Author;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    public function index()
    {
        $quotes = Quote::with(['author', 'tags'])->paginate(8);
        $categories = Category::get()->toTree()->unique('name');
        return view('/quotes', compact(['quotes', 'categories']));
    }

    public function get(Request $request)
    {
        return $quotesQuery = Quote::with('author');

        /*if($request->has('favourite')){
            $quotesQuery->whereHas('favorites', function ($query){
                $query->where('user_id', Auth::id());
            });
        }

        return $quotesQuery->latest()->get();*/
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
