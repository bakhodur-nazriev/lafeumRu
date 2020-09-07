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
        $photos = Photo::published('desc')->paginate(30);
        return view("/photos", compact("photos"));
    }

    public function get(Request $request)
    {
        $photosQuery = Photo::byPublishAt();

        return $this->processIndexRequestItems($request, $photosQuery, 'description');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'description' => 'required'
        ]);
        $newPhotoData = $request->all();
        if ($request->hasFile("image")) {
            $newPhotoData["path"] = $this->saveImage(time(), $request->image, self::PHOTOS_PATH);
        }

        return Photo::create($newPhotoData);
    }

    public function update(Photo $photo, Request $request)
    {
        $newPhotoData = $request->all();
        
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
