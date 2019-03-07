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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::post('/validate/email','UserController@validateEmail')->name('validate.mail');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');


	//admin routes
    Route::group(['middleware' => 'isAdmin'], function () {
    	Route::resource('news', 'NewsController',['except' => [
		    'show'
		]])->names('news');

		Route::resource('users', 'UserController')->names('users');
		Route::get('/categories/all','NewsController@showAllCategories')->name('categories');
		Route::delete('/category/{category}','NewsController@deleteCategory')->name('category.destroy');
		Route::get('/categories/create','NewsController@createCategory')->name('category.create');
		Route::post('/categories','NewsController@storeCategory')->name('category.store');
		Route::get('/news/restore/{news}', 'NewsController@restore')->name('news.restore');
	});

	Route::get('/news/{news}','NewsController@show')->name('news.show');
});
