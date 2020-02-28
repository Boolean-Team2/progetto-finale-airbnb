<?php

// Index route
Route::get('/', 'MainController@index')->name('index');

// Auth routes
Auth::routes();

// Show user profile route
Route::get('/account/{id}/show', 'LoggedUserController@show')->name('account.show');

// Edit user profile route
Route::patch('/account/{id}/edit', 'LoggedUserController@edit')->name('account.edit');

// User messages routes
Route::get('/account/{id}/messages/show', 'MessageController@messagesShow')->name('account.messages.show');
Route::get('/account/{id}/messages/message/{idm}', 'MessageController@messageShow')->name('account.message.show');
Route::get('/account/{id}/messages/message/{idm}/change-state', 'MessageController@changeState')->name('account.message.changeState');

// User's apartments statistics
Route::get('/account/{id}/apartments-statistics', 'LoggedUserController@apartmentsStatistics')->name('account.statistics.show');
Route::get('/account/{id}/apartment/{ida}/statistics', 'LoggedUserController@apartmentStatistics')->name('apartmet.statistics.show');

// User show his sponsor payments
Route::get('/account/{id}/payments', 'LoggedUserController@userPayments')->name('user.sponsor.payments');

// User sponsor apartments
Route::get('/account/{id}/apartment/{ida}/sponsor', 'LoggedUserController@apartmentSponsor')->name('apartment.sponsor');

// Ads payments
Route::post('/account/{id}/apartment/{ida}/sponsor/checkout', 'LoggedUserController@checkout') -> name('checkout');

// Show user's apartments
Route::get('/account/{id}/apartments/show', 'ApController@apartmentsShow')->name('account.apartments.show');

// Create user's apartment
Route::get('/account/apartments/create', 'ApController@apartmentCreate')->name('account.apartments.create');

// Store user's apartment
Route::post('/account/apartments/store', 'ApController@apartmentStore')->name('account.apartments.store');

// Edit user's apartment
Route::get('/account/apartment/{ida}/edit', 'ApController@apartmentEdit')->name('account.apartment.edit');

// Update user's apartment
Route::patch('/account/apartment/{ida}/update', 'ApController@apartmentUpdate')->name('account.apartment.update');

// Delete user's apartment
Route::get('/account/{id}/apartment/{ida}/delete', 'ApController@apartmentDelete')->name('account.apartment.delete');

// * * * GUEST ROUTES * * * //
Route::get('/apartment/{id}/show', 'MainController@apartmentShow')->name('apartment.show');

// * * * MAIL ROUTES * * * //
Route::post('/sendmail/{ida}', 'MainController@sendMail')->name('sendmail');

// Chat routes
Route::get('/chats', 'ChatController@index')->name('chats');
Route::get('/chat/{id}', 'ChatController@getMessage')->name('chat');
Route::post('chat', 'ChatController@sendMessage');
