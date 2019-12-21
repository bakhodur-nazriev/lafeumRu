<?php

// use Symfony\Component\Routing\Annotation\Route;


// use Illuminate\Routing\Route;

Auth::routes();

// Route::get('/videos', 'VideosController@index');
// Route::get('/{any}', 'AppController@index')->where('any', '.*');

// Route::group(['middleware' => ['auth']], function(){
  Route::get('/dashboard', 'AdminController@index')->name('dashboard');

// });

// Route::group(['middleware' => 'auth'], function () {
//   Route::get('dashboard', function () {
//     if ($this->user->isAdmin())
//       return redirect('/dashboard/admin');
//     if ($this->user->isManager())
//       return redirect('/dashboard/manager');

//     return redirect('/');
//   });
// });

// Route::get('dashboard/admin', 'Admin\dashboard@index');
// Route::get('dashboard/manage', 'Manager\dashboard@index');
// Route::get('users', 'PagesController@manageUsers');

Route::get('/', 'AppController@index')->name('home');
Route::get('/authors', 'AuthorsController@index')->name('authors');
Route::get('/channels', 'ChannelsController@index')->name('channels');

Route::get('/contacts', 'ContactsController@create')->name('contacts');
Route::post('/contacts', 'ContactsController@store')->name('contacts');

Route::get('/knowledges', 'KnowledgesController@index')->name('knowledges');
Route::get('/knowledges/{knowledge}', 'KnowledgesController@show')->name('knowledge');
Route::post('/knowledges', 'KnowledgesController@store');

Route::get('/photos', 'PhotosController@index')->name('photos');
Route::get('/quotes', 'QuotesController@index')->name('quotes');
Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/videos', 'VideosController@index')->name('videos');
Route::get('/vocabulary', 'VocabularyController@index')->name('vocabulary');
