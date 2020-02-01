<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    const PHOTOS_PATH = "/img/photos/";

    public function index()
    {
        $photos = Photo::orderBy('id')->paginate(12);
        return view('/photos', compact('photos'));
    }

    public function get()
    {
        return $photos = Photo::latest()->get();
    }

    public function store(Request $request)
    {
        $newPhotoData = $request->only(['description']);
        if ($request->hasFile("image")) {
            $newPhotoData['image'] = $this->saveImage(time(), $request->image);
        }
        $newPhoto = Photo::create($newPhotoData);

        return $newPhoto;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $photo = Photo::find($id);
        $photo->update($request->all());
        $photo->save();
        return response()->json($photo);
    }

    public function delete($id)
    {
        return Photo::destroy($id);
    }

    private function saveImage($name, $file)
    {
        $extension = $file->extension();
        $filename = $name . "." . $extension;

        $file->move(public_path(self::PHOTOS_PATH), $filename);

        return self::PHOTOS_PATH . $filename;
    }
}
