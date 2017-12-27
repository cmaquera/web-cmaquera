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

Route::resource('/dashboard/subscribers', 'SubscriberController');
Route::get('/subscribers/data', 'SubscriberController@getSubscribers')->name('api.subscribers');

Route::resource('/dashboard/projects', 'ProjectController');
Route::get('/projects/data', 'ProjectController@getProjects')->name('api.projects');

