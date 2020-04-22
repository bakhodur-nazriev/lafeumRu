<?php

namespace App\Http\Controllers;

use App\Category;
use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Term::with('categories')->latest()->paginate(15);
        $categories = Category::where('type', Term::class)->get()->toTree()->unique("name");
        return view('/terms', compact(['terms', 'categories']));
    }

    public function show(Term $term)
    {
        return view('shows.showTerm', compact('term'));
    }

    public function indexVocabulary()
    {
        $vocabularies = Term::all();
        $categories = Category::where('type', Term::class)->get()->toTree()->unique("name");
        return view("/vocabulary", compact(["vocabularies", "categories"]));
    }

    public function showVocabulary($id)
    {
        $vocabulary = Term::with('categories')->where('id', $id)->first();
        return view("shows.showVocabulary", compact("vocabulary"));
    }

    public function get(Request $request)
    {
        $termsQuery = Term::with('categories');
        return $termsQuery->latest()->get();
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
