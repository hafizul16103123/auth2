<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
	// Auth::routes();
Route::group(['middleware'=>['auth','admin']],function(){
	Route::get('admin/dashboard', 'AdminController@index')->name('admin_dashboard');
	Route::resource('roles', 'Role\\RolesController');
	

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');

	Route::get('test',function(){
		return view('test');
	})->name('test');

});
Route::group(['middleware'=>['auth','user']],function(){
	Route::get('user/dashboard', 'UserController@index')->name('user_dashboard');
});
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', 'HomeController@index')->name('home');


