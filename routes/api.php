<?php

use Illuminate\Http\Request;

Route::middleware("auth:api")->get("/user", function (Request $request) {
    return $request->user();
});

/* Users */
//Route::get("/users", "UsersController@index");

/* Quotes */
Route::get("/quotes", "QuotesController@get");
Route::post("/quotes", "QuotesController@store");
Route::put("/quotes/{id}", "QuotesController@update");
Route::delete("/quotes/{id}", "QuotesController@delete");

/* Authors */
Route::get("/authors", "AuthorsController@get");
Route::post("/authors", "AuthorsController@store");
Route::put("/authors/{id}", "AuthorsController@update");
Route::delete("/authors/{id}", "AuthorsController@delete");

/* Photos */
Route::get("/photos", "PhotosController@get");
Route::post("/photos", "PhotosController@store");
Route::put("/photos/{id}", "PhotosController@update");
Route::delete("/photos/{id}", "PhotosController@delete");

/* Terms */
Route::get("/terms", "TermsController@get");
Route::post("/terms", "TermsController@store");
Route::put("/terms/{id}", "TermsController@update");
Route::delete("/terms/{id}", "TermsController@delete");

/* Knowledge Areas */
Route::get("/knowledge-areas", "KnowledgesController@get");
Route::post("/knowledge-areas", "KnowledgesController@store");
Route::put("/knowledge-areas/{id}", "KnowledgesController@update");
Route::delete("/knowledge-areas/{id}", "KnowledgesController@delete");

/* Videos */
Route::get("/videos", "VideosController@get");
Route::post("/videos", "VideosController@store");
Route::put("/videos/{id}", "VideosController@update");
Route::delete("/videos/{id}", "VideosController@delete");

/* Channels */
Route::get("/channels", "ChannelsController@get");
Route::post("/channels", "ChannelsController@store");
Route::put("/channels/{id}", "ChannelsController@update");
Route::delete("/channels/{id}", "ChannelsController@delete");

/* Favourites */
/*Route::get();*/
