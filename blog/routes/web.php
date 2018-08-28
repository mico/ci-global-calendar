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
    //return view('welcome');
    return view('home');
});

Route::resource('posts','PostController');

Route::resource('categories','CategoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// TODO - Da finire
Route::get('/blog', function () {
    $posts = App\Post::all();
    return view('posts.show', compact('post'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
