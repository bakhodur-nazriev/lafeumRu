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
Route::put('/quotes', 'QuotesController@update');
Route::delete('/quotes', 'QuotesController@delete');

//Authors
Route::get('/authors', 'AuthorsController@get');
Route::post('/authors', 'AuthorsController@store');

//Photos
Route::get('/photos', 'PhotosController@get');
