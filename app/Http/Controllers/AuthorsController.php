<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    const AUTHORS_PHOTOS_PATH = "/authors/";

    public function __construct() {
        $this->authorizeResource(Author::class);
    }

    public function index()
    {
        $authors = Author::all();
        return view("/authors", compact("authors"));
    }

    public function show($slug)
    {
        $authors = Author::all();
        $currentAuthor = Author::with('quotes.categories')->where('slug', $slug)->first();
        return view('shows.showAuthor', compact(['authors', 'currentAuthor']));
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

    public function update(Author $author, Request $request)
    {
        $newPhotoData = $request->only(["name", "biography"]);
        if ($request->hasFile("photo")) {
            $newPhotoData["photo"] = $this->saveImage(time(), $request->photo, self::AUTHORS_PHOTOS_PATH);
        }
        $author->update($newPhotoData);
        return $author;
    }

    public function destroy(Author $author)
    {
        $author->delete();
    }
}
