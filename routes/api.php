<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {

    /* Users */
    Route::get("/users", "UsersController@index");
    Route::get("/users/{user}", "UsersController@show");
    Route::put("/users/{user}", "UsersController@update");
    Route::delete("/users/{user}", "UsersController@destroy");

    /* Roles */
    Route::get("/roles", "RolesController@index");

    /* Categories */
    Route::get("/categories", "CategoriesController@get");
    Route::put("/categories", "CategoriesController@updateTree");
    Route::post("/categories", "CategoriesController@store");
    Route::put("/categories/{category}", "CategoriesController@update");
    Route::delete("/categories/{category}", "CategoriesController@destroy");

    /* Quotes */
    Route::get("/quotes", "QuotesController@get");
    Route::post("/quotes", "QuotesController@store");
    Route::put("/quotes/{quote}", "QuotesController@update");
    Route::delete("/quotes/{quote}", "QuotesController@destroy");

    /* Authors */
    Route::get("/authors", "AuthorsController@get");
    Route::post("/authors", "AuthorsController@store");
    Route::put("/authors/{author}", "AuthorsController@update");
    Route::delete("/authors/{author}", "AuthorsController@destroy");

    /* Author Groups */
    Route::get("/author-groups", "AuthorGroupController@index");

    /* Photos */
    Route::get("/photos", "PhotosController@get");
    Route::post("/photos", "PhotosController@store");
    Route::put("/photos/{photo}", "PhotosController@update");
    Route::delete("/photos/{photo}", "PhotosController@destroy");

    /*Term Types*/
    Route::get("/term-types", "TermTypesController@get");

    /* Terms */
    Route::get("/terms", "TermsController@get");
    Route::post("/terms", "TermsController@store");
    Route::put("/terms/{term}", "TermsController@update");
    Route::delete("/terms/{term}", "TermsController@destroy");

    /* Knowledge Areas */
    Route::get("/knowledge-areas", "KnowledgesController@get");
    Route::put("/knowledge-areas", "KnowledgesController@updateTree");
    Route::post("/knowledge-areas", "KnowledgesController@store");
    Route::put("/knowledge-areas/{knowledge}", "KnowledgesController@update");
    Route::delete("/knowledge-areas/{knowledge}", "KnowledgesController@destroy");

    /* Videos */
    Route::get("/videos", "VideosController@get");
    Route::post("/videos", "VideosController@store");
    Route::put("/videos/{video}", "VideosController@update");
    Route::delete("/videos/{video}", "VideosController@destroy");

    /* Channels */
    Route::get("/channels", "ChannelsController@get");
    Route::post("/channels", "ChannelsController@store");
    Route::put("/channels/{channel}", "ChannelsController@update");
    Route::delete("/channels/{channel}", "ChannelsController@destroy");

    /* Favourites */
    Route::get("/favourites", "FavoriteController@index");

    /* User-Feedbacks */
    Route::get("/feedbacks", "FeedbacksController@get");

    /* Quotes Trashed */
    Route::get("/quotes-trashed", "QuotesController@getTrashed");
    Route::put("/quote-trashed/{quote}", "QuotesController@restored");
    Route::delete("/quote-trashed/{quote}", "QuotesController@forceDeleted");

    /* Terms Trashed */
    Route::get("/terms-trashed", "TermsController@getTrashed");
    Route::put("/term-trashed/{term}", "TermsController@restored");
    Route::delete("/term-trashed/{term}", "TermsController@forceDeleted");

    /* Videos Trashed */
    Route::get("/videos-trashed", "VideosController@getTrashed");
    Route::put("/video-trashed/{video}", "VideosController@restored");
    Route::delete("/video-trashed/{video}", "VideosController@forceDeleted");

    /* Photos Trashed */
    Route::get("/photos-trashed", "PhotosController@getTrashed");
    Route::put("/photo-trashed/{photo}", "PhotosController@restored");
    Route::delete("/photo-trashed/{photo}", "PhotosController@forceDeleted");

    /* Authors Trashed */
    Route::get("/authors-trashed", "AuthorsController@getTrashed");
    Route::put("/author-trashed/{author}", "AuthorsController@restored");
    Route::delete("/author-trashed/{author}", "AuthorsController@forceDeleted");

    /* Channels Trashed */
    Route::get("/channels-trashed", "ChannelsController@getTrashed");
    Route::put("/channel-trashed/{channel}", "ChannelsController@restored");
    Route::delete("/channel-trashed/{channel}", "ChannelsController@forceDeleted");
});

Route::get("/summary/{id}", "PostsController@termSummary");

Route::get("/", "AppController@index")->name("home");

Route::get("/authors", "AuthorsController@index")->name("author");
Route::get("/authors/filmy-i-serialy", "AuthorsController@showMovies")->name("author.showMovies");
Route::get("/authors/poslovicy-i-pogovorki", "AuthorsController@showProverbs")->name("author.showProverbs");
Route::get("/authors/{author}", "AuthorsController@show")->name("author");

Route::get("/channels", "ChannelsController@index")->name("channels");
Route::get("/channels/{channel}", "ChannelsController@show")->name("channels");;

Route::get("/contacts", "FeedbacksController@create")->name("contacts.create");
Route::post("/contacts", "FeedbacksController@store")->name("contacts.store");

Route::get("/knowledge", "KnowledgesController@index")->name("knowledge");
Route::get("/knowledge/{knowledge}", "KnowledgesController@show")->name("knowledge");

Route::get("/photo", "PhotosController@index")->name("photo");

Route::get("/quotes", "QuotesController@index")->name("quotes");

Route::get("/terms", "TermsController@index")->name("terms");
Route::get("/terms/links-search", "TermsController@linksSearch")->name("terms.search");

Route::get("/quotes/{categorySlug}", "CategoriesController@showQuotes")->name("category.quotes");
Route::get("/terms/{categorySlug}", "CategoriesController@showTerms")->name("category.terms");
Route::get("/vocabulary/{categorySlug}", "CategoriesController@showVocabulary")->name("category.vocabulary");
Route::get("/vocabulary", "TermsController@indexVocabulary")->name("vocabulary");
Route::get("/videos", "VideosController@index")->name("videos");
Route::get("/videos/{categorySlug}", "CategoriesController@showVideos")->name("category.videos");

/* Favorite */

Route::get("/privacy-policy", "AppController@privacy")->name('privacy');
Route::get("/terms-of-use", "AppController@termsOfUse")->name('terms-of-use');
Route::get("/about-us", "AppController@aboutUs")->name('about-us');

/* Should be on bottom */
Route::get("/{post}", "PostsController@show")->name('post');
