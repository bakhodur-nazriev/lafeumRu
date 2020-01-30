<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('id')->paginate(12);
        return view('/photos', compact('photos'));
    }

    public function get()
    {
        return $photos = Photo::latest()->get();
    }

    protected function store(Request $request)
    {
        $photo = Photo::create($request->all());
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("/home/bakhodur/Desktop/MyProjects/lafeum/public/img/photos", $filename);
            $photo->image = $filename;
        } else {
            return $request;
            $photo->photo = "";
        }
        $photo->save();
        return "success";
    }

    protected function update(Request $request, $id)
    {
    }

    protected function delete($id)
    {
        return Photo::destroy($id);
    }
}
