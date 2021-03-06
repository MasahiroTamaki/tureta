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
    return view('top');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//postsのCRUDに関するルート
Route::resource('posts', 'PostController');

//usersのCRUDに関するルート
Route::resource('users', 'UserController');