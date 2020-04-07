<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Admin', 'domain' => env('ADMIN_HOST_URL','admin.portfolio.test')], function () {

    // Authentication
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return response()->json([
            'message' => 'Successfully retrieve resource',
            'user' => auth('api')->user()
        ], 200);
    });

    // Users API
     Route::resource('users', 'UsersController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    Route::resources([
        'intro'           => 'IntroController',
        'about'           => 'AboutController',
        'experience'      => 'ExperienceController',
    ]);
});
