<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    const PHOTOS_PATH = "/img/photos/";

    public function __construct()
    {
        $this->authorizeResource(Photo::class);
    }

    public function index()
    {
        $photos = Photo::paginate(30);
        return view("/photos", compact("photos"));
    }

    public function get(Request $request)
    {
        return Photo::latest()->paginate($request->perPage ?: 30);
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

    public function update(Photo $photo, Request $request)
    {
        $newPhotoData = $request->only(["description"]);
        if ($request->hasFile("image")) {
            $newPhotoData["image"] = $this->saveImage(time(), $request->image, self::PHOTOS_PATH);
        }
        $photo->update($newPhotoData);
        return $photo;
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
    }
}
