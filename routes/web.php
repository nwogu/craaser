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

//Company public review page
Route::get('/{slug}', 'ReviewController@show')->name('company-review-page');
//Add Review from Customer
Route::any('/{slug}/add', 'ReviewController@create')->name('add-company-review');
//Delete Review
Route::any('/app/review/delete/{id}', 'ReviewController@delete')->name('delete-review');
//COnfirm delete review
Route::any('/app/review/confirmdelete/{id}', 'ReviewController@confirmDelete')->name('confirm-delete-review');
//Publish Review
Route::any('/app/review/publish/{id}', 'ReviewController@publish')->name('publish-review');
//Auth
Route::group(['prefix' => 'app'], function () {
    Auth::routes();
});
//Dashboard Overview
Route::get('/app/dashboard', 'HomeController@index')->name('dashboard');
//List Contacts
Route::any('/app/contact', 'ContactController@index')->name('contacts');
//List Reviews o dashboard
Route::any('/app/review', 'ReviewController@index')->name('reviews');
//Add Contact
Route::any('/app/contact/add-contact', 'ContactController@store')->name('add-contact');
//Change Contact Status
Route::any('/app/contact/change-status/{contact}', 'ContactController@changeStatus')->name('change-status');
//List Template
Route::any('/app/template', 'TemplateController@index')->name('templates');
//Add Template
Route::any('/app/template/add-template', 'TemplateController@store')->name('add-template');
//Edit Template
Route::any('/app/template/edit-template/{template}', 'TemplateController@edit')->name('edit-template');
//Update Template
Route::any('/app/template/update-template/{template}', 'TemplateController@update')->name('update-template');
//Delete Template
Route::any('/app/template/delete-template/{template}', 'TemplateController@destroy')->name('delete-template');