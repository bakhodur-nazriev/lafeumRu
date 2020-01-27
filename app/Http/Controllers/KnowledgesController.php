<?php

namespace App\Http\Controllers;

use App\Knowledge;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    public function index()
    {
        $knowledgeAreas = Knowledge::all();
        return view('/knowledge.index', compact('knowledgeAreas'));
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
        $knowledge = Knowledge::finc($id);
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
