<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin') // con cosa inizia l'url
      ->namespace('Admin') // nome della cartella dove si trova il controller
      ->middleware('auth') // questa funzione permette di accedere alle funzioni solo se loggato
      ->name('admin.')
      ->group(function() { // gruppo di controller che può lavorare dentro Admin
        Route::resource('posts', 'PostController');
      });

Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/show{post}', 'PostController@show')->name('posts.show');
