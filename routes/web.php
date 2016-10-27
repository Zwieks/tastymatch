<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
// // Authentication Login routes...
Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');
// Dutch
Route::get('/inloggen', 'Auth\LoginController@showLoginForm');
Route::post('/inloggen', 'Auth\LoginController@login');
// Facebook
Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/inloggen/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/inloggen/facebook/callback', 'Auth\LoginController@handleProviderCallback');

// // Logout routes...
Route::get('/logout', 'Auth\LoginController@logout');
//Dutch
Route::get('/uitloggen', 'Auth\LoginController@logout');

// // Registration routes...
$this->get('/register', 'Auth\RegisterController@showRegistrationForm');
$this->post('/register', 'Auth\RegisterController@register');
// Dutch
$this->get('/inschrijven', 'Auth\RegisterController@showRegistrationForm');
$this->post('/inschrijven', 'Auth\RegisterController@register');

// Homepage
Route::get('/', ['uses' => 'UserController@index', 'as' => 'users']);

// Contact
Route::get('/contact', 'ContactController@index');

// About
Route::get('/about', 'AboutController@index');
// Dutch
Route::get('/overons', 'AboutController@index');

// Zoeken
Route::get('/search', ['as' => 'index', 'uses' => 'SearchController@index']);
// Dutch
Route::get('/zoeken', ['as' => 'index', 'uses' => 'SearchController@index']);

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