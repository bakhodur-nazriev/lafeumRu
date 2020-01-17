<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Term::with('tags')->paginate(8);
        return view('/terms', compact('terms'));
    }

    public function get()
    {
        return Term::latest()->get();
    }

    public function store(Request $request)
    {
        return Term::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $term = Term::find($id);
        $term->update($request->all());
        return response()->json($term);
    }

    public function delete($id)
    {
        Term::destroy($id);
        return response()->json("ok");
    }
}
