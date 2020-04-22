<?php


Auth::routes();

Route::get("/dashboard{any}", "UsersController@index")->where("any", ".*");
Route::get("/dashboard", "UsersController@index")->name("dashboard");

Route::get("/", "AppController@index")->name("home");

Route::get("/author", "AuthorsController@index")->name("author");
Route::get("/author/{slug}", "AuthorsController@show")->name("author");

Route::get("/channels", "ChannelsController@index")->name("channels");
Route::get("/channels/{slug}", "ChannelsController@show")->name("channels");;

Route::get("/contacts", "ContactsController@create")->name("contacts");
Route::post("/contacts", "ContactsController@store")->name("contacts");

Route::get("/knowledge", "KnowledgesController@index")->name("knowledge");
Route::get("/knowledge/{slug}", "KnowledgesController@show")->name("knowledge");

Route::get("/photo", "PhotosController@index")->name("photo");

Route::get("/quotes", "QuotesController@index")->name("quotes");
Route::get("/quotes/{quote}", "QuotesController@index")->name("quotes");

Route::get("/terms", "TermsController@index")->name("terms");
Route::get("/terms/{slug}", "TermsController@show");

Route::get("/vocabulary", "TermsController@indexVocabulary")->name("vocabulary");
Route::get("/vocabulary/{slug}", "TermsController@showVocabulary");

Route::get("/videos", "VideosController@index")->name("videos");

//Favorite
Route::put("/toggle-favourite", "FavoriteController@toggle")->middleware("auth");
