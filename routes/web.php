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

Route::get('/', 'PosterController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<<<<<<< HEAD
Route::get('/profile', 'UserController@show')->name('profile');
Route::post('profile', 'UserController@update_profile_img');
Route::get('/profile/delete', 'UserController@delete');

Route::get('/profile/index', 'AdminController@user_index');
Route::get('/profile/show/{id?}', 'AdminController@user_show');
Route::get('/profile/delete/{id?}', 'AdminController@user_delete');
=======
Route::resource('post', 'PosterController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::get('posts', 'PosterController@index');
>>>>>>> 55445691748a762270ef731bcbb1a3e9f84edcf1
