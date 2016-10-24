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

// // Authentication Login routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
// Dutch
Route::get('/inloggen', 'Auth\AuthController@getLogin');
Route::post('/inloggen', 'Auth\AuthController@postLogin');
// Facebook
Route::get('/login/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('/inloggen/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('/inloggen/facebook/callback', 'Auth\AuthController@handleProviderCallback');

// // Logout routes...
Route::get('/logout', 'Auth\AuthController@getLogout');
//Dutch
Route::get('/uitloggen', 'Auth\AuthController@getLogout');

// // Registration routes...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
// Dutch
Route::get('/inschrijven', 'Auth\AuthController@getRegister');
Route::post('/inschrijven', 'Auth\AuthController@postRegister');

// Homepage
Route::get('/', ['uses' => 'UserController@index', 'as' => 'users']);

// Contact
Route::get('/contact', 'ContactController@index');

// About
Route::get('/about', 'AboutController@index');
// Dutch
Route::get('/overons', 'AboutController@index');

// Cookies
Route::get('/cookies', ['uses' => 'UserController@index', 'as' => 'users']);
Route::auth();

Route::get('/home', 'HomeController@index');

// API
Route::get('/getRequestKvkDetails', 'ApiController@showDetails');

// AJAX
Route::post('/ajax/search', 'AjaxController@getSearch');

// Blog
Route::get('blog', array('as' => 'index', 'uses' => 'BlogController@Index'));
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@Single']) -> where('slug', '[\w\d\-\_]+');
Route::get('blog/admin', array('as' => 'admin_area', 'uses' => 'BlogController@Admin'));
Route::post('blog/add', array('as' => 'add_new_post', 'uses' => 'BlogController@Update'));