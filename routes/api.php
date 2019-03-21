<?php

use App\Http\Controllers\Api\Changelog\ChangelogController;
use App\Http\Controllers\Api\CompletedTasksController;
use App\Http\Controllers\Api\GitController;
use App\Http\Controllers\Api\Notifications\NotificationsController;
use App\Http\Controllers\Api\Notifications\SimpleNotificationsController;
use App\Http\Controllers\Api\Notifications\UserNotificationsController;
use App\Http\Controllers\Api\Notifications\UserUnreadNotificationsController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\TasksTagsController;
use App\Http\Controllers\PhotoController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function() {

    // TASKS
    Route::get('/v1/tasks','\\' . TasksController::class . '@index');                // BROWSE
    Route::get('/v1/tasks/{task}','\\' . TasksController::class . '@show');          // READ
    Route::delete('/v1/tasks/{task}','\\' . TasksController::class . '@destroy');    // DELETE
    Route::post('/v1/tasks','\\' . TasksController::class . '@store');               // CREATE
    Route::put('/v1/tasks/{task}','\\' . TasksController::class . '@update');        // EDIT

    // USER TASKS
    Route::get('/v1/user/tasks','Api\LoggedUserTasksController@index');
    Route::get('/v1/user/tasks/{task}','Api\LoggedUserTasksController@show');
    Route::post('/v1/user/tasks','Api\LoggedUserTasksController@store');
    Route::put('/v1/user/tasks/{task}','Api\LoggedUserTasksController@update');
    Route::delete('/v1/user/tasks/{task}','Api\LoggedUserTasksController@destroy');

    // Completed tasks -> Estats
    Route::delete('/v1/completed_task/{task}','\\' . CompletedTasksController::class . '@destroy');
    Route::post('/v1/completed_task/{task}','\\' . CompletedTasksController::class . '@store');

    // TAGS
    Route::get('/v1/tags','\\'. TagsController::class . '@index');                // BROWSE
    Route::get('/v1/tags/{tag}','\\'. TagsController::class . '@show');          // READ
    Route::delete('/v1/tags/{tag}','\\'. TagsController::class . '@destroy');    // DELETE
    Route::post('/v1/tags','\\'. TagsController::class . '@store');               // CREATE
    Route::put('/v1/tags/{tag}','\\'. TagsController::class . '@update');         // EDIT

    // Users
    Route::get('/v1/users','Api\UsersController@index');
    Route::get('/v1/regular_users','Api\RegularUsersController@index');

    Route::get('/v1/git/info','\\' . GitController::class . '@index');

    //Changelog
    Route::get('/v1/changelog','\\' . ChangelogController::class . '@index');
//    Route::get('/v1/changelog/module/{module}','Tenant\Api\Changelog\ChangelogModuleController@index');
//    Route::get('/v1/changelog/user/{user}','Tenant\Api\Changelog\ChangelogUserController@index');
//    Route::get('/v1/changelog/loggable/{loggable}/{loggableId}','Tenant\Api\Changelog\ChangelogLoggableController@index');

    Route::put('/v1/tasks/{task}/tags', '\\' . TasksTagsController::class . '@update' );
//    Route::put('/v1/tasks/{task}/tags', 'TasksTagsController@update' );

    Route::post('/v1/user/photo', '\\' . PhotoController::class . '@store');

    // Notifications
    Route::get('/v1/notifications','\\' . NotificationsController::class . '@index');
    Route::post('/v1/notifications/multiple','\\' . NotificationsController::class . '@destroyMultiple');
    Route::delete('/v1/notifications/{notification}','\\' . NotificationsController::class . '@destroy');
    Route::get('/v1/user/notifications','\\' . UserNotificationsController::class . '@index');
    Route::get('/v1/user/unread_notifications','\\' . UserUnreadNotificationsController::class . '@index');
    Route::delete('/v1/user/unread_notifications/all','\\' . UserUnreadNotificationsController::class . '@destroyAll');
    Route::delete('/v1/user/unread_notifications/{notification}','\\' . UserUnreadNotificationsController::class . '@destroy');


    // Simple notifications
    Route::post('/v1/simple_notifications/','\\' . SimpleNotificationsController::class . '@store');
});

