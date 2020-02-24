<?php

use Illuminate\Http\Request;

Route::get('/apartments/show', 'MyApiController@showApartmentsApi');

Route::get('/apartment/statistic', 'MyApiController@myApStatistic');
