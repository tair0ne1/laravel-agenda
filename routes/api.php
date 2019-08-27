<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/activities', 'ActivitiesController');

Route::post('/activities/{id}/finish', 'ActivitiesController@finishActivity');

Route::get('/status', 'StatusController@index');

Route::get('/users', 'UserController@index');
