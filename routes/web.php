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

Route::get('/profile/show/{id?}', 'UserController@show');
Route::post('profile', 'UserController@update_profile_img');
Route::get('/profile/delete/{id?}', 'UserController@delete');

//Feedbacks

Route::get('/feedback_store', 'FeedbackController@create');
Route::post('/feedback_store', 'FeedbackController@store');

Route::get('/admin/index', 'AdminController@user_index');

Route::resource('post', 'PosterController', ['only' => ['create', 'show', 'edit', 'store']])->middleware('auth');
Route::get('posts', 'PosterController@index');
Route::post('/cat_update', 'CategoryController@update');
