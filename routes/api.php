<?php

use Illuminate\Http\Request;

Route::get('/apartments/show', 'MyApiController@showApartmentsApi');
Route::get('/apartment/msgsStatistic', 'MyApiController@messagesStatistic');
Route::get('/apartment/viewsStatistic', 'MyApiController@viewsStatistics');

