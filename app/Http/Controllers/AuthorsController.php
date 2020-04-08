<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    const AUTHORS_PHOTOS_PATH = "/authors/";

    public function index()
    {
        $authors = Author::all();
        return view("/authors", compact("authors"));
    }

    public function show(Author $author)
    {
        $categories = Category::get()->toTree()->unique("name");
        return view("shows.showAuthor", compact(["author", "categories"]));
    }

    public function get()
    {
        return Author::latest()->get();
    }

    public function store(Request $request)
    {
        /*$author = author::create($request->all());
        if ($request->hasfile("photo")) {
            $file = $request->file("photo");
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . "." . $extension;
            $file->move("/home/bakhodur/Desktop/MyProjects/lafeum/public/img/authors", $filename);
            $author->photo = $filename;
        } else {
            return $request;
            $author->photo = "";
        }
        $author->save();
        return "success";*/

        $newPhotoData = $request->only(["name", "biography"]);
        if ($request->hasFile("photo")) {
            $newPhotoData["photo"] = $this->saveImage(time(), $request->photo, self::AUTHORS_PHOTOS_PATH);
        }
        return Author::create($newPhotoData);
    }

    public function update($id, Request $request)
    {
        $author = Author::find($id);
        $newPhotoData = $request->only(["name", "biography"]);
        if ($request->hasFile("photo")) {
            $newPhotoData["photo"] = $this->saveImage(time(), $request->photo, self::AUTHORS_PHOTOS_PATH);
        }
        $author->update($newPhotoData);
        return $author;
    }

    public function delete($id)
    {
        Author::destroy($id);
        return response()->json("ok");
    }
}
