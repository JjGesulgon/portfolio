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

Route::group(['namespace' => 'Admin', 'domain' => 'admin.portfolio.test'], function(){
       
        // Authentication
        // Route::get('/auth/get-admin', 'AuthController@admin');
        Route::get('/login',  [ 'as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/login', 'Auth\LoginController@login');
        Route::post('/logout', [ 'as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
        Route::get('/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm');
        Route::post('/password/confirm', 'Auth\ConfirmPasswordController@confirm');
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        Route::get('/register', 'Auth\RegisterController@showRegistationForm');
        Route::post('/register', 'Auth\RegisterController@register');

        Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('admins.index');

        Route::prefix('admin')->name('admin.')->group(function(){
                Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
        });
});

Route::group(['namespace' => 'Main', 'domain' => 'portfolio.test'], function(){
        Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('main.index');
});