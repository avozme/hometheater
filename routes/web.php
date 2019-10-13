<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All movies
Route::get('/', 'MovieController@list')->name('movie.index');
Route::get('/movies', 'MovieController@list')->name('movie.index');
Route::get('/movies/search/{searchString}', 'MovieController@search')->name('movie.search');
Route::get('/movies/scan/', 'MovieController@scanDir')->name('movie.scanMany');

// Single movie
Route::get('/movie/play/{id}', 'MovieController@play')->name('movie.play');
Route::get('/movie/scan/{id}', 'MovieController@scanSingle')->name('movie.scanOne');

// Movie REST
Route::resource('movie', 'MovieController');
//Route::get('/movie/{id}', 'Movie@show')->name('movie.show');
//Route::get('/movie/edit/{id}', 'Movie@edit')->name('movie.edit');
//Route::patch('/movie/update/{id}', 'Movie@update')->name('movie.update');
//Route::delete('/movie/delete/{id}', 'Movie@destroy')->name('movie.destroy');
//Etc.

// Auth
Auth::routes();
Route::get('/home', 'MovieController@list')->name('movie.index');
Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/");
});
