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

Route::get('/{slug}/reviews', 'ReviewController@show');
Route::any('/{slug}/add', 'ReviewController@create');
Route::any('/home/delete/{id}', 'HomeController@delete');
Route::any('/home/confirmdelete/{id}', 'HomeController@confirmDelete');
Route::any('/home/publish/{id}', 'HomeController@publish');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
