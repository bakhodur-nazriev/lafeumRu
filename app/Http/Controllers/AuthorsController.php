<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('/authors', compact('authors'));
    }

    public function get()
    {
        return Author::latest()->get();
    }

    public function store(Request $request)
    {
        $author = Author::create($request->all());
        return response()->json($author);
    }

    public function update($id, Request $request)
    {
        $author = Author::find($id);
        $author->update($request->all());
        return response()->json($author);
    }

    public function delete($id)
    {
        Author::destroy($id);
        return response()->json("ok");
    }
}
