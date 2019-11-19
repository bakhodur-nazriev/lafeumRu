<?php

// use Symfony\Component\Routing\Annotation\Route;

Auth::routes();

// Route::get('/videos', 'VideosController@index');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{any}', 'AppController@index')->where('any', '.*');
