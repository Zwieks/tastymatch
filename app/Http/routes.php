<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// // Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// // Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
// Dutch
Route::get('auth/inschrijven', 'Auth\AuthController@getRegister');
Route::post('auth/inschrijven', 'Auth\AuthController@postRegister');

// Homepage
Route::get('/', ['uses' => 'UserController@index', 'as' => 'users']);

// Cookies
Route::get('/cookies', ['uses' => 'UserController@index', 'as' => 'users']);