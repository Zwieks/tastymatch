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
Route::auth();
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
Route::get('/home', ['uses' => 'UserController@index', 'as' => 'users']);

// Contact
Route::get('/contact', 'ContactController@index');

// About
Route::get('/about', 'AboutController@index');
// Dutch
Route::get('/overons', 'AboutController@index');

// Cookies
Route::get('/cookies', ['uses' => 'UserController@index', 'as' => 'users']);

// API
Route::get('/getRequestKvkDetails', 'ApiController@getKvkDetails');

// AJAX
Route::post('/ajax/search', 'AjaxController@getSearch');

// Blog
Route::get('blog', array('as' => 'index', 'uses' => 'BlogController@Index'));
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@Single']) -> where('slug', '[\w\d\-\_]+');
Route::get('blog/admin', array('as' => 'admin_area', 'uses' => 'BlogController@Admin'));
Route::post('blog/add', array('as' => 'add_new_post', 'uses' => 'BlogController@Update'));

// FOODSTANDS
Route::get('foodstand', ['as' => 'index', 'uses' => 'FoodstandsController@index']) -> where('slug', '[\w\d\-\_]+');
//Route::get('foodstand/{slug}', ['as' => 'foodstand.single', 'uses' => 'FoodstandsController@Single']) -> where('slug', '[\w\d\-\_]+');

// ENTERTAINERS
Route::post('/entertainers/{slug}', ['as' => 'blog.single', 'uses' => 'EntertainersController@Single']) -> where('slug', '[\w\d\-\_]+');

// EVENTS
Route::post('/events/{slug}', ['as' => 'blog.single', 'uses' => 'EventsController@Single']) -> where('slug', '[\w\d\-\_]+');

//USER ACCESS ONLY
Route::group(['middleware' => 'auth'], function()
{
	// Upload image
	Route::post('admin/upload', ['as' => 'user.upload', 'uses' => 'ImageController@upload']);

	// Zoeken
	Route::get('/search', ['as' => 'index', 'uses' => 'SearchController@index']);
	// Dutch
	Route::get('/zoeken', ['as' => 'index', 'uses' => 'SearchController@index']);
});