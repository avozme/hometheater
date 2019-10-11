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
Route::get('/', 'Movie@list')->name('movie.index');
Route::get('/movies', 'Movie@list')->name('movie.index');
Route::get('/movies/search/{searchString}', 'Movie@search')->name('movie.search');
Route::get('/movies/scan/', 'Movie@scanDir')->name('movie.scanMany');

// Single movie
Route::get('/movie/play/{id}', 'Movie@play')->name('movie.play');
Route::get('/movie/scan/{id}', 'Movie@scanSingle')->name('movie.scanOne');

// Movie REST
Route::resource('movie', 'Movie');
//Route::get('/movie/{id}', 'Movie@show')->name('movie.show');
//Route::get('/movie/edit/{id}', 'Movie@edit')->name('movie.edit');
//Route::patch('/movie/update/{id}', 'Movie@update')->name('movie.update');
//Route::get('/movie/delete/{id}', 'Movie@destroy')->name('movie.destroy');

// Auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
