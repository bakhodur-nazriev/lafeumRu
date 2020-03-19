<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view("/authors", compact("authors"));
    }
    public function get()
    {
        return Author::latest()->get();
    }
    public function store(Request $request)
    {
        /*        $author = Author::create($request->all());
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
            $newPhotoData["photo"] = $this->saveImage(time(), $request->photo);
        }
        return Author::create($newPhotoData);
    }
    public function update($id, Request $request)
    {
        $author = Author::find($id);
        $newPhotoData = $request->only(["name", "biography"]);
        if ($request->hasFile("photo")) {
            $newPhotoData["photo"] = $this->saveImage(time(), $request->photo);
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
