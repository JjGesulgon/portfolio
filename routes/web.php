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

Route::group(['namespace' => 'Admin', 'domain' => 'admin.jjgesulgon.dev'], function(){
       
        // Authentication
        // Route::get('/auth/get-admin', 'AuthController@admin');
        Route::get('/login',  [ 'as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/login', 'Auth\LoginController@login');
        Route::post('/logout', [ 'as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
        Route::get('/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm');
        Route::post('/password/confirm', 'Auth\ConfirmPasswordController@confirm');
        // Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        // Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        // Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
        // Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('show-password-reset-form');
        // Route::get('/register', 'Auth\RegisterController@showRegistationForm')->name('show-registration-form');
        // Route::post('/register', 'Auth\RegisterController@register')->name('register');

        // Forget Password
        Route::get('/password/reset/', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email/', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        // Reset Password
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('show-password-reset-form');
        Route::post('/password/reset/', 'Auth\ResetPasswordController@reset')->name('password.reset');

        // Register
        Route::get('register/', 'Auth\RegisterController@showRegistrationForm')->name('show-registration-form');
        Route::post('register/', 'Auth\RegisterController@register')->name('register');

        Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('admins.index');

        Route::prefix('admin')->name('admin.')->group(function(){
                Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
        });
});

Route::group(['namespace' => 'Main', 'domain' => 'jjgesulgon.dev'], function(){
        Route::get('/{any}', 'SpaController@index')->where('any', '.*')->name('main.index');
});
