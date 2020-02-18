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

Auth::routes();


Route::get('profile/', 'ProfileController@index');
Route::get('/home', 'ProfileController@home')->name('home')->middleware('auth');
Route::get('profile/{user}/', 'ProfileController@show');
Route::get('profile/{user}/edit', 'ProfileController@edit');
Route::patch('profile/{user}', 'ProfileController@update');
Route::get('profile/{user}/follow/', 'ProfileController@indexFollow')->name('follow');
Route::get('profile/{user}/followed/', 'ProfileController@indexFollowed')->name('followed');

Route::get('p/create', 'PostsController@create')->middleware('auth');
Route::post('p/', 'PostsController@store')->middleware('auth');
Route::get('p/{post}/', 'PostsController@show');
Route::delete('p/{post}', 'PostsController@destroy');

Route::post('/follow/{user}', 'FollowsController@store');

