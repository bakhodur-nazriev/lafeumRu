<?php

// use Symfony\Component\Routing\Annotation\Route;
// use Illuminate\Routing\Route;

Auth::routes();

Route::get("/dashboard{any}", "AdminController@index")->where("any", ".*");
Route::get("/dashboard", "AdminController@index")->name("dashboard");

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

Route::group(["middleware" => "App\Http\Middleware\AdminMiddleware"],
    function () {
        Route::match(["get", "post"], "/adminPage", "HomeController@admin");
    });

Route::group(["middleware" => "App\Http\Middleware\AuthorMiddleware"],
    function () {
        Route::match(["get", "post"], "/authorPage", "HomeController@author");
    });

Route::group(["middleware" => "App\Http\Middleware\MemberMiddleware"],
    function () {
        Route::match(["get", "post"], "/memberPage", "HomeController@member");
    });

