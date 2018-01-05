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
/*
 * Route::get('/', function () {
    return view('welcome');
});
 */


Route::group(
    ['middleware' => 'auth'],
        function(){

        /* Albums */
        Route::get('/','AlbumController@index');
        Route::get('/albums','AlbumController@index');
        Route::get('/albums/{id}/delete','AlbumController@delete');
        Route::get('/albums/{id}/edit','AlbumController@edit');
        Route::patch('/albums/{id}/update','AlbumController@update');
        Route::get('/albums/create','AlbumController@create')->name('create');
        Route::post('/albums/save','AlbumController@save');

        /* Photos */
        Route::get('/albums/{id}/photos','PhotoController@show')->name('photos');
        Route::get('/photos/{id}/delete','PhotoController@delete');
        Route::get('/photos/{id}/edit','PhotoController@edit');
        Route::patch('/photos/{id}/update','PhotoController@update');
        Route::get('/photos/{id}/create','PhotoController@create');
        Route::post('/photos/save','PhotoController@save');

    });







Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


