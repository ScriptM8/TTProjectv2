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
Route::get('/get-manual', 'UserController@getManual');

Route::get('/admin/index', 'AdminController@user_index');

//Poster (post)
Route::resource('post', 'PosterController');
Route::get('posts', 'PosterController@index');
Route::get('post/{id}/delete', 'PosterController@delete');
Route::get('profile/show/{id}/posts', 'PosterController@listown');
Route::post('posts', 'PosterController@postFilter');

//Photo
Route::resource('photo', 'PhotoController');
Route::get('post/{id}/photo/add', 'PhotoController@create');
Route::get('photo/{id}/delete', 'PhotoController@destroy');

//Feedback
Route::get('/feedback_store', 'FeedbackController@create');
Route::post('/feedback_store', 'FeedbackController@store');
Route::get('/feedback_edit/{id}', 'FeedbackController@edit')->name('feedback.edit');
Route::post('/feedback_edit/{id}', 'FeedbackController@update')->name('feedback.update');

//??
Route::post('/cat_update', 'CategoryController@update');

//Localization
Route::get('lang/{locale}','LanguageController');
