<?php


Auth::routes();

Route::get("/dashboard{any}", "UsersController@index")->where("any", ".*");
Route::get("/dashboard", "UsersController@index")->name("dashboard");

Route::get("/", "AppController@index")->name("home");
Route::get("/authors", "AuthorsController@index")->name("authors");

Route::get("/channels", "ChannelsController@index")->name("channels");
Route::get("/channels/{channel}", "ChannelsController@show")->name("channels");;

Route::get("/contacts", "ContactsController@create")->name("contacts");
Route::post("/contacts", "ContactsController@store")->name("contacts");

Route::get("/knowledges", "KnowledgesController@index")->name("knowledges");
Route::get("/knowledges/{knowledge}", "KnowledgesController@show")->name("knowledge");

Route::get("/photos", "PhotosController@index")->name("photos");
Route::get("/quotes", "QuotesController@index")->name("quotes");

Route::get("/terms", "TermsController@index")->name("terms");
Route::get("/terms/{term}", "VocabularyController@show");

Route::get("/videos", "VideosController@index")->name("videos");
Route::get("/vocabulary", "VocabularyController@index")->name("vocabulary");

//Favorite
Route::put("/toggle-favourite", "FavoriteController@toggle")->middleware("auth");
