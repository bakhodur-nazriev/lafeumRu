<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get("/dashboard{any}", "AppController@dashboard")->where("any", ".*")->middleware("auth")->name("dashboard");
Route::get("/dashboard", "AppController@dashboard")->middleware("auth")->name("dashboard");

Route::get("/", "AppController@index")->name("home");

Route::get("/authors", "AuthorsController@index")->name("author");
Route::get("/authors/filmy-i-serialy", "AuthorsController@showMovies")->name("author.showMovies");
Route::get("/authors/poslovicy-i-pogovorki", "AuthorsController@showProverbs")->name("author.showProverbs");
Route::get("/authors/{author}", "AuthorsController@show")->name("author");

Route::get("/channels", "ChannelsController@index")->name("channels");
Route::get("/channels/{channel}", "ChannelsController@show")->name("channels");;

Route::get("/contacts", "FeedbacksController@create")->name("feedbacks.create");
Route::post("/feedbacks", "FeedbacksController@store")->name("feedbacks.store");

Route::get("/knowledge", "KnowledgesController@index")->name("knowledge");
Route::get("/knowledge/{knowledge}", "KnowledgesController@show")->name("knowledge");

Route::get("/photo", "PhotosController@index")->name("photo");

Route::get("/quotes", "QuotesController@index")->name("quotes");

Route::get("/terms", "TermsController@index")->name("terms");
Route::get("/terms/links-search", "TermsController@linksSearch")->name("terms.search");

Route::get("/quotes/{categorySlug}", "CategoriesController@showQuotes")->name("category.quotes");
Route::get("/terms/{categorySlug}", "CategoriesController@showTerms")->name("category.terms");
Route::get("/videos/{categorySlug}", "CategoriesController@showVideos")->name("category.videos");
Route::get("/vocabulary/{categorySlug}", "CategoriesController@showVocabulary")->name("category.vocabulary");


Route::get("/vocabulary", "TermsController@indexVocabulary")->name("vocabulary");

Route::get("/videos", "VideosController@index")->name("videos");

//Favorite
Route::put("/toggle-favourite", "FavoriteController@toggle")->middleware("auth");

Route::get("/{post}", "PostsController@show")->name('post');
