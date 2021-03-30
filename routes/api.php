<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group([
    'namespace' => 'App\Http\Controllers\Api'
], function () {

    // member
	Route::post('/login', 'UserController@login');
    Route::post('/register-user', 'UserController@register');
    Route::group([
        'middleware' => 'jwt.auth'
    ], function () {
        Route::post('/register', 'RegistrationController@register');
        Route::get('/list', 'RegistrationController@getRegistrations');
        Route::post('/update/{id}', 'RegistrationController@update');
        Route::delete('/delete/{id}', 'RegistrationController@delete');
    });
});
