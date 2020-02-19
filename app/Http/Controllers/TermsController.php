<?php

namespace App\Http\Controllers;

use App\Category;
use App\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Term::with('tags')->latest()->paginate(8);
        $categories = Category::all();
        return view('/terms', compact(['terms', 'categories']));
    }

    public function get()
    {
        return Term::with('tags')->latest()->get();
    }

    public function store(Request $request)
    {
        return Term::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $term = Term::find($id);
        $term->update($request->all());
        $term->save();
        return response()->json($term);
    }

    public function delete($id)
    {
        Term::destroy($id);
        return response()->json("ok");
    }
}
