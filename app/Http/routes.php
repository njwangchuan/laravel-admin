<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

  Auth::routes();
  Route::get('/logout', 'Auth\LoginController@logout');
  Route::get('home', 'HomeController@index');
  Route::get('auto-login', 'HomeController@autoLogin');
  Route::get('copyright', 'HomeController@copyright');
  Route::get('captcha/create', ['as' => 'captcha.create', 'uses' => 'CaptchaController@create']);
  Route::get('/', function () {
    return redirect('home');
  })->middleware('guest');

  /***************    Admin routes  **********************************/
  Route::group(['prefix' => 'admin', 'middleware' => 'role:admin|owner'], function () {

    # Admin Dashboard
    Route::get('dashboard', 'Admin\DashboardController@index');

    # User
    Route::get('user/data', 'Admin\UserController@data');
    Route::get('user/{user}/show', 'Admin\UserController@show');
    Route::get('user/{user}/edit', 'Admin\UserController@edit');
    Route::get('user/{user}/delete', 'Admin\UserController@delete');
    Route::resource('user', 'Admin\UserController');

    # Role
    Route::get('role/data', 'Admin\RoleController@data');
    Route::get('role/{role}/show', 'Admin\RoleController@show');
    Route::get('role/{role}/edit', 'Admin\RoleController@edit');
    Route::get('role/{role}/delete', 'Admin\RoleController@delete');
    Route::resource('role', 'Admin\RoleController');

    # Permission
    Route::get('permission/data', 'Admin\PermissionController@data');
    Route::get('permission/{permission}/show', 'Admin\PermissionController@show');
    Route::get('permission/{permission}/edit', 'Admin\PermissionController@edit');
    Route::get('permission/{permission}/delete', 'Admin\PermissionController@delete');
    Route::resource('permission', 'Admin\PermissionController');

  });

});
