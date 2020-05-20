<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    const AUTHORS_PHOTOS_PATH = "/img/authors/";

    public function __construct() {
        $this->authorizeResource(Author::class);
    }

    public function index()
    {
        $authors = Author::all();
        return view("/authors", compact("authors"));
    }

    public function show(Author $author)
    {
        $authors = Author::all();
        $currentAuthor = $author->load('quotes.categories');
        return view('shows.author', compact(['authors', 'currentAuthor']));
    }

    public function get()
    {
        return Author::latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author_group_id' => 'required'
        ]);

        $newAuthorData = $request->all();

        if ($request->hasFile("photo")) {
            $newAuthorData["photo"] = $this->saveImage(time(), $request->photo, self::AUTHORS_PHOTOS_PATH);
        }

        return Author::create($newAuthorData);
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
