<?php

// Index route
Route::get('/', 'MainController@index')->name('index');

// Auth routes
Auth::routes();
Route::redirect('/home', '/');

// Show user profile route
Route::get('/account/{id}/show', 'LoggedUserController@show')->name('account.show');

// Edit user profile route
Route::patch('/account/{id}/edit', 'LoggedUserController@edit')->name('account.edit');

// Show user's apartments
Route::get('/account/{id}/apartments/show', 'ApController@apartmentShow')->name('account.apartments.show');

// Create user's apartment
Route::get('/account/apartments/create', 'ApController@apartmentCreate')->name('account.apartments.create');

// Store user's apartment
Route::post('/account/apartments/store', 'ApController@apartmentStore')->name('account.apartments.store');