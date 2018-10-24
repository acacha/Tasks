<?php

use App\Task;
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

Route::get('/v1/tasks','Api\TasksController@index');                // BROWSE
Route::get('/v1/tasks/{task}','Api\TasksController@show');          // READ
Route::delete('/v1/tasks/{task}','Api\TasksController@destroy');    // DELETE
Route::post('/v1/tasks','Api\TasksController@store');               // CREATE
Route::put('/v1/tasks/{task}','Api\TasksController@update');         // EDIT

// Completed tasks -> Estats
Route::delete('/v1/completed_task/{task}','Api\CompletedTasksController@destroy');
Route::post('/v1/completed_task/{task}','Api\CompletedTasksController@store');
