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
        $photo = $request->file('photo');
        $fileName = $photo->getClientOriginalName();
        $photo->move('/home/bakhodur/Desktop/MyProjects/lafeum/public/img/authors', $fileName);

        return "success";
        // return Author::create($request->all());
    }

    public function update($id, Request $request)
    {
        $author = Author::find($id);
        $author->update($request->all());
        $author->save();
        return response()->json($author);
    }

    public function delete($id)
    {
        Author::destroy($id);
        return response()->json("ok");
    }
}
