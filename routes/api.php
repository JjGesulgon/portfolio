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
        'about'           => 'AboutController',
        'experience'      => 'ExperienceController',
        'skills'          => 'SkillsController',
        'projects'        => 'ProjectsController',
        'projectImages'   => 'ProjectImagesController',
    ]);

    Route::get('list-projects', 'ProjectsController@projectList');
});

Route::group(['namespace' => 'Main', 'domain' => env('MAIN_HOST_URL','portfolio.test')], function () {

    Route::resources([
        'about'           => 'AboutController',
        // 'experience'      => 'ExperienceController',
        'skills'          => 'SkillsController',
        'projects'        => 'ProjectsController',
    ]);

    // Route::post('send-mail', 'ContactController@sendEmail');
    Route::post('contact-me', 'ContactController@sendEmail');
    // Route::get('send-mail', function () {
   
    //     $details = [
    //         'title' => 'Mail from jjgesulgon.dev',
    //         'body' => 'This is for testing email using smtp'
    //     ];
       
    //     \Mail::to('jjgesulgon@gmail.com')->send(new \App\Mail\ContactMail($details));
       
    //     dd("Email is Sent.");
    // });
});
