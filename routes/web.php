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
})->name('home');

Route::get('/{slug}', 'ReviewController@show')->name('company-review-page');
Route::any('/{slug}/add', 'ReviewController@create')->name('add-company-review');
Route::any('/app/review/delete/{id}', 'ReviewController@delete')->name('delete-review');
Route::any('/app/review/confirmdelete/{id}', 'ReviewController@confirmDelete')->name('confirm-delete-review');
Route::any('/app/review/publish/{id}', 'ReviewController@publish')->name('publish-review');
Route::group(['prefix' => 'app'], function () {
    Auth::routes();
});

Route::get('/app/dashboard', 'HomeController@index')->name('dashboard');
Route::any('/app/contact', 'ContactController@index')->name('contacts');
Route::any('/app/review', 'ReviewController@index')->name('reviews');
