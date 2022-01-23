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
Auth::routes();

Route::get('/', function () {
    return view('layouts.home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    // CRUD Profile
    Route::resource('profile','ProfileController');

    Route::get('/all_user', 'ProfileController@all_user');
    Route::delete('/user/{user_id}', 'ProfileController@remove');

    Route::get('/all_post', 'PostController@index')->name('all_post');
    Route::post('/all_post', 'PostController@store');

    Route::get('/like_post', 'PostController@like_post');

    Route::get('/list_follow', 'ProfileController@list_follow');

    Route::post('/comment/{post_id}', 'PostController@add_comment');
    Route::delete('/comment/{comment_id}', 'PostController@delete_comment');

    Route::post('/like/{post_id}', 'PostController@add_like');
    Route::delete('/like/{like_id}', 'PostController@remove_like');

    Route::post('/follow/{user_id}', 'ProfileController@follow');
    Route::delete('/follow/{follow_id}', 'ProfileController@unfollow');

    Route::get('/post/create', 'PostController@create');
    Route::get('/post/{post_id}/edit', 'PostController@edit');
    Route::put('/post/{post_id}', 'PostController@update');
    Route::delete('/post/{post_id}', 'PostController@destroy');
    Route::put('/post/{post_id}/like', 'PostController@like');

});









