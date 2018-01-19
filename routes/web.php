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
    return view('index');
})->name('index');

Route::get('/me', function () {
    return view('me');
})->name('me');

Route::get('/posts', function () {
    return view('posts');
})->name('posts');

Route::get('/projects', function () {
    return view('projects');
})->name('projects');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Panel
Route::resource('/dashboard/panel', 'PanelController');

// Subcribers
Route::resource('/dashboard/subscribers', 'SubscriberController');
Route::get('/subscribers/data', 'SubscriberController@getSubscribers')->name('data.subscribers');

// Projects
Route::resource('/dashboard/projects', 'ProjectController')->middleware('auth');
Route::get('/projects/data', 'ProjectController@getProjects')->name('data.projects');

// Posts
Route::resource('/dashboard/posts', 'PostController');
Route::get('/posts/data', 'PostController@getPosts')->name('data.posts');
Route::get('/posts/search', 'PostController@autocomplete')->name('search.posts');
Route::get('/posts/{post}', 'PostController@showPost');
Route::get('/p', 'PostController@posts_users');

// Tags
Route::resource('/dashboard/tags', 'TagController');
Route::get('/tags/data', 'TagController@getTags')->name('data.tags');