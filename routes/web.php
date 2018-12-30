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
//List Group Contact
Route::any('/app/contact/group-contact', 'ContactController@listGroupContact')->name('group-contacts');
//Create Group Contact
Route::any('/app/contact/create-group-contact', 'ContactController@createGroupContact')->name('create-group-contact');
//Edit Group Contact
Route::any('/app/contact/edit-group-contact/{groupContact}', 'ContactController@editGroupContact')->name('edit-group-contact');
//Update Group Contact
Route::any('/app/contact/update-group-contact/{groupContact}', 'ContactController@updateGroupContact')->name('update-group-contact');
//Delete Group Contact
Route::any('/app/contact/delete-group-contact/{groupContact}', 'ContactController@deleteGroupContact')->name('delete-group-contact');
//Confirm Delete Group Contact
Route::any('/app/contact/confirm-delete-group-contact/{groupContact}', 'ContactController@confirmDeleteGroupContact')->name('confirm-delete-group-contact');




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
//List Group Template
Route::any('/app/template/group-template', 'TemplateController@listGroupTemplate')->name('group-templates');
//Create Group Template
Route::any('/app/template/create-group-template', 'TemplateController@createGroupTemplate')->name('create-group-template');
//Edit Group Template
Route::any('/app/template/edit-group-template/{groupTemplate}', 'TemplateController@editGroupTemplate')->name('edit-group-template');
//Update Group Template
Route::any('/app/template/update-group-template/{groupTemplate}', 'TemplateController@updateGroupTemplate')->name('update-group-template');
//Delete Group Template
Route::any('/app/template/delete-group-template/{groupTemplate}', 'TemplateController@deleteGroupTemplate')->name('delete-group-template');
//Confirm Delete Group Template
Route::any('/app/template/confirm-delete-group-template/{groupTemplate}', 'TemplateController@confirmDeleteGroupTemplate')->name('confirm-delete-group-template');
//Confirm Delete Template
Route::any('/app/template/confirm-delete-template/{template}', 'TemplateController@confirmDeleteTemplate')->name('confirm-delete-template');



//List Campaigns
Route::any('/app/campaign', 'CampaignController@index')->name('campaigns');
//Crete Campaign
Route::any('/app/campaign/create-campaign', 'CampaignController@create')->name('create-campaign');