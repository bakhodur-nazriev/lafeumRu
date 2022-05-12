<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(["middleware" => "auth"], function () {
    Route::get("/profile", "ProfileController@index")->name("profile");
    Route::put("/profile/{profile}", "ProfileController@update");

    Route::get("/dashboard{any}", "AppController@dashboard")->where("any", ".*")->name("dashboard");
    Route::get("/dashboard", "AppController@dashboard")->name("dashboard");
    Route::get("/favorites", "AppController@favorites")->name("favorites");
    Route::put("/toggle-favourite", "FavoriteController@toggle");

    Route::get("/", "AppController@index")->name("home");
    Route::get("/quotes", "QuotesController@index")->name("quotes");
    Route::get("/terms", "TermsController@index")->name("terms");
    Route::get("/videos", "VideosController@index")->name("videos");
    Route::get("/photos", "PhotosController@index")->name("photos");
    Route::get("/authors", "AuthorsController@index")->name("author");
    Route::get("/knowledge", "KnowledgesController@index")->name("knowledge");
    Route::get("/channels", "ChannelsController@index")->name("channels");
    Route::get("/vocabulary", "TermsController@indexVocabulary")->name("vocabulary");

    Route::get("/authors/filmy-i-serialy", "AuthorsController@showMovies")->name("author.showMovies");
    Route::get("/authors/poslovicy-i-pogovorki", "AuthorsController@showProverbs")->name("author.showProverbs");
    Route::get("/authors/{author}", "AuthorsController@show")->name("author");
    Route::get("/channels/{channel}", "ChannelsController@show")->name("channels");;
    Route::get("/knowledge/{knowledge}", "KnowledgesController@show")->name("knowledge");

    Route::get("/quotes/{categorySlug}", "CategoriesController@showQuotes")->name("category.quotes");
    Route::get("/terms/{categorySlug}", "CategoriesController@showTerms")->name("category.terms");
    Route::get("/videos/{categorySlug}", "CategoriesController@showVideos")->name("category.videos");
    Route::get("/vocabulary/{categorySlug}", "CategoriesController@showVocabulary")->name("category.vocabulary");

    Route::get("/privacy-policy", "AppController@privacy")->name('privacy');
    Route::get("/terms-of-use", "AppController@termsOfUse")->name('terms-of-use');
    Route::get("/about-us", "AppController@aboutUs")->name('about-us');
    Route::get("/contacts", "FeedbacksController@create")->name("contacts.create");
    Route::post("/contacts", "FeedbacksController@store")->name("contacts.store");

    Route::get("/terms/links-search", "TermsController@linksSearch")->name("terms.search");
    /* Should be on bottom */
    Route::get("/{post}", "PostsController@show")->name('post');

});
