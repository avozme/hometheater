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
Route::get('/', 'Movie@list');
Route::get('/movies', 'Movie@list');
Route::get('/movies/search/{searchString}', 'Movie@search');
Route::get('/movies/scan', 'Movie@scan');

// Single movie
Route::get('/movie/{id}', 'Movie@show');
Route::get('/movie/play/{id}', 'Movie@play');
Route::get('/movie/edit/{id}', 'Movie@edit');
Route::get('/movie/delete/{id}', 'Movie@destroy');

// Movie CRUD
Route::resource('movie', 'Movie');
