<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Quotes
Route::get('/quotes', 'QuotesController@get');
Route::post('/quotes', 'QuotesController@store');
Route::put('/quotes/{id}', 'QuotesController@update');
Route::delete('/quotes/{id}', 'QuotesController@delete');

//Authors
Route::get('/authors', 'AuthorsController@get');
Route::post('/authors', 'AuthorsController@store');
Route::put('/authors', 'AuthorsController@update');
Route::delete('/authors', 'AuthorsController@delete');

//Photos
Route::get('/photos', 'PhotosController@get');
Route::post('/photos', 'PhotosController@store');
Route::put('/photos', 'PhotosController@update');
Route::delete('/photos', 'PhotosController@delete');

//Terms
Route::get('/terms', 'TermsController@get');
Route::post('/terms', 'TermsController@store');
Route::put('/terms', 'TermsController@update');
Route::delete('/terms', 'TermsController@delete');

//Knowledge Areas
Route::get('/knowledge_areas', 'KnowledgesController@get');
Route::post('/knowledge_areas', 'KnowledgesController@store');
Route::put('/knowledge_areas', 'KnowledgesController@update');
Route::delete('/knowledge_areas', 'KnowledgesController@delete');

//Videos
Route::get('/videos', 'VideosController@get');
Route::post('/videos', 'VideosController@store');
Route::put('/videos', 'VideosController@update');
Route::delete('/videos', 'VideosController@delete');

//Channels
Route::get('/channels', 'ChannelsController@get');
Route::post('/channels', 'ChannelsController@store');
Route::put('/channels', 'ChannelsController@update');
Route::delete('/channels', 'ChannelsController@delete');
