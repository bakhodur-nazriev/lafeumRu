<?php

namespace App\Http\Controllers;

use App\Category;
use App\Knowledge;
use App\Term;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    public function index()
    {
        $knowledgeAreas = Knowledge::latest()->get();
        return view('knowledgeArea', compact('knowledgeAreas'));
    }

    public function show(Knowledge $knowledge)
    {
        $categories = Category::get()->toTree()->unique("name");
        return view("shows.showKnowledge", compact(['knowledge', 'categories']));
    }

    public function get()
    {
        return $knowledgeAreas = Knowledge::latest()->get();
    }

    public function store(Request $request)
    {
        return Knowledge::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $knowledge = Knowledge::find($id);
        $knowledge->update($request->all());
        $knowledge->save();
        return response()->json($knowledge);
    }

    public function delete($id)
    {
        Knowledge::destroy($id);
        return response()->json("ok");
    }
}
