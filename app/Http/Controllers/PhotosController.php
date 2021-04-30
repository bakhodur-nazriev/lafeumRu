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
        return view("/photos");
    }

    public function getPhotos()
    {
        $photos = Photo::published('desc')->paginate(15);
        return response()->json(collect($photos));
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

    public function getTrashed(Request $request)
    {
        $photosTrashedQuery = Photo::onlyTrashed()->byPublishAt();
        return $this->processIndexRequestItems($request, $photosTrashedQuery, 'description');
    }

    public function restored($id)
    {
        $photo = Photo::onlyTrashed()->find($id);
        $photo->restore();
    }

    public function forceDeleted($id)
    {
        $photo = Photo::onlyTrashed()->find($id);
        $photo->forceDelete();
    }
}
