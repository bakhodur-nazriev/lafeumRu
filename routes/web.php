<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get("/dashboard{any}", "AppController@dashboard")->where("any", ".*")->middleware("auth")->name("dashboard");
Route::get("/dashboard", "AppController@dashboard")->middleware("auth")->name("dashboard");

Route::get("/", "AppController@index")->name("home");

Route::get("/author", "AuthorsController@index")->name("author");
Route::get("/author/{author}", "AuthorsController@show")->name("author");

Route::get("/channels", "ChannelsController@index")->name("channels");
Route::get("/channels/{channel}", "ChannelsController@show")->name("channels");;

Route::get("/contacts", "ContactsController@create")->name("contacts");
Route::post("/contacts", "ContactsController@store")->name("contacts");

Route::get("/knowledge", "KnowledgesController@index")->name("knowledge");
Route::get("/knowledge/{knowledge}", "KnowledgesController@show")->name("knowledge");

Route::get("/photo", "PhotosController@index")->name("photo");

Route::get("/quotes", "QuotesController@index")->name("quotes");

Route::get("/terms", "TermsController@index")->name("terms");

Route::get("/vocabulary", "TermsController@indexVocabulary")->name("vocabulary");
Route::get("/vocabulary/{slug}", "TermsController@showVocabulary");

Route::get("/videos", "VideosController@index")->name("videos");

//Favorite
Route::put("/toggle-favourite", "FavoriteController@toggle")->middleware("auth");
