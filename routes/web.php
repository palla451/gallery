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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/albums','AlbumController@index');
Route::get('/albums/{id}/delete','AlbumController@delete');
Route::get('/albums/{id}/edit','AlbumController@edit');
//Route::post('/albums/{id}/update','AlbumController@update');
Route::patch('/albums/{id}/update','AlbumController@update');
Route::get('/albums/create','AlbumController@create');
Route::post('/albums/save','AlbumController@save');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

