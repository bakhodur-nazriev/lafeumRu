<?php

// use Symfony\Component\Routing\Annotation\Route;

Auth::routes();

// Route::get('/videos', 'VideosController@index');
// Route::get('/{any}', 'AppController@index')->where('any', '.*');

Route::get('/', 'AppController@index')->name('home');
Route::get('/authors', 'AuthorsController@index')->name('authors');
Route::get('/channels', 'ChannelsController@index')->name('channels');
Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::get('/knowledge-areas', 'KnowledgeAreasController@index')->name('knowledge-areas');
Route::get('/photos', 'PhotosController@index')->name('photos');
Route::get('/quotes', 'QuotesController@index')->name('quotes');
Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/videos', 'VideosController@index')->name('videos');
Route::get('/vocabulary', 'VocabularyController@index')->name('vocabulary');
