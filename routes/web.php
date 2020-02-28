<?php

// * * * INDEX ROUTE * * * //
Route::get('/', 'MainController@index')->name('index');

// * * * AUTH ROUTES * * * //
Auth::routes();

// * * * MESSAGES ROUTES * * * //
Route::get('/account/{id}/messages/show', 'MessageController@messagesShow')->name('account.messages.show');
Route::get('/account/{id}/messages/message/{idm}', 'MessageController@messageShow')->name('account.message.show');
Route::get('/account/{id}/messages/message/{idm}/change-state', 'MessageController@changeState')->name('account.message.changeState');

// * * * APARTMENTS STATISTICS * * * //
Route::get('/account/{id}/apartments-statistics', 'StatisticsController@apartmentsStatistics')->name('account.statistics.show');
Route::get('/account/{id}/apartment/{ida}/statistics', 'StatisticsController@apartmentStatistics')->name('apartmet.statistics.show');

// * * * ADS & PAYMENTS ROUTES * * * //
Route::get('/account/{id}/payments', 'AdsController@userPayments')->name('user.sponsor.payments');
Route::get('/account/{id}/apartment/{ida}/sponsor', 'AdsController@apartmentSponsor')->name('apartment.sponsor');
Route::post('/account/{id}/apartment/{ida}/sponsor/checkout', 'AdsController@checkout') -> name('checkout');

// * * * APARTMENTS ROUTES * * * //
Route::get('/account/{id}/apartments/', 'ApController@apartmentsShow')->name('account.apartments.show');
Route::get('/account/apartment/create', 'ApController@apartmentCreate')->name('account.apartment.create');
Route::post('/account/apartment/store', 'ApController@apartmentStore')->name('account.apartment.store');
Route::get('/account/apartment/{ida}/edit', 'ApController@apartmentEdit')->name('account.apartment.edit');
Route::patch('/account/apartment/{ida}/update', 'ApController@apartmentUpdate')->name('account.apartment.update');
Route::get('/account/{id}/apartment/{ida}/delete', 'ApController@apartmentDelete')->name('account.apartment.delete');

// * * * USER ROUTES * * * //
Route::get('/account/{id}/show', 'LoggedUserController@show')->name('account.show');
Route::patch('/account/{id}/edit', 'LoggedUserController@edit')->name('account.edit');

// * * * GUEST ROUTES * * * //
Route::get('/apartment/{id}/show', 'MainController@apartmentShow')->name('apartment.show');

// * * * MAIL ROUTES * * * //
Route::post('/sendmail/{ida}', 'MainController@sendMail')->name('sendmail');

// * * * CHATS ROUTES * * * //
Route::get('/chats', 'ChatController@index')->name('chats');
Route::get('/chat/{id}', 'ChatController@getMessage')->name('chat');
Route::post('chat', 'ChatController@sendMessage');
