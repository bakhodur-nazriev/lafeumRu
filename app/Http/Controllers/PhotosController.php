<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    const PHOTOS_PATH = "/photos/";

    public function index()
    {
        /*$photos = Photo::orderBy("id")->paginate(15);*/
        $photos = Photo::paginate(15);
        return view("/photos", compact("photos"));
    }

    public function get()
    {
        return $photos = Photo::latest()->get();
    }

    public function store(Request $request)
    {
        $newPhotoData = $request->only(["description"]);
        if ($request->hasFile("image")) {
            $newPhotoData["image"] = $this->saveImage(time(), $request->image);
        }
        $newPhoto = Photo::create($newPhotoData);

        return $newPhoto;
    }

    public function update(Request $request, $id)
    {
        $image = Photo::find($id);
        $newPhotoData = $request->only(["description"]);
        if ($request->hasFile("image")) {
            $newPhotoData["image"] = $this->saveImage(time(), $request->image, self::PHOTOS_PATH);
        }
        $image->update($newPhotoData);
        return $image;
    }

    public function delete($id)
    {
        return Photo::destroy($id);
    }



}
