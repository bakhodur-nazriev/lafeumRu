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
    Route::post("/quotes-trashed", "QuotesController@restoreTrashed");
    Route::delete("/quotes-trashed/{quote}", "QuotesController@forceDeleteTrashed");

    /* Terms Trashed */
    Route::get("/terms-trashed", "TermsController@getTrashed");
    Route::post("/terms-trashed", "TermsController@restoreTrashed");
    Route::delete("/terms-trashed/{term}", "TermsController@forceDeleteTrashed");

    /* Videos Trashed */
    Route::get("/videos-trashed", "VideosController@getTrashed");
    Route::post("/videos-trashed", "VideosController@restoreTrashed");
    Route::delete("/videos-trashed/{video}", "VideosController@forceDeleteTrashed");

    /* Photos Trashed */
    Route::get("/photos-trashed", "PhotosController@getTrashed");
    Route::post("/photos-trashed", "PhotosController@restoreTrashed");
    Route::delete("/photos-trashed/{photo}", "PhotosController@getTrashed");

});

Route::get("/summary/{id}", "PostsController@termSummary");
