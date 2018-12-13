<?php

use App\Http\Controllers\LoggedUserTasksController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasquesController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// TODO
Route::post('/login_alt','Auth\LoginAltController@login');

// TDD -> TEST DRIVEN DEVELOPMENT

// MIDDLEWARE

//GRUP DE URLS PER USUARIS AUTENTICATS
Route::middleware(['auth'])->group(function () {
    Route::get('/about',function () {
        return view('about');
    });

    Route::view('/contact', 'contact');

    Route::get('/tasks','\\'. TasksController::class . '@index');
    Route::post('/tasks','\\'. TasksController::class . '@store');
    Route::delete('/tasks/{id}','\\'. TasksController::class . '@destroy');
    Route::put('/tasks/{id}','\\'. TasksController::class . '@update');

    Route::get('/task_edit/{id}','TasksController@edit');

    //Complete
    Route::post('/completed_task/{task}','CompletedTasksController@store');
    //Uncomplete
    Route::delete('/completed_task/{task}','CompletedTasksController@destroy');


    Route::get('/tasks_vue', 'TasksVueController@index');

    // TASQUES OK

    Route::get('/tasques','\\'. TasquesController::class . '@index');
    Route::get('/tasques','\\'. TasquesController::class . '@index');
    Route::get('/home', '\\'. TasquesController::class . '@index');

    // USER TASKS
    Route::get('/user/tasks','\\'. LoggedUserTasksController::class . '@index');

    Route::impersonate();

    // TAGS
    Route::get('/tags','\\'. TagsController::class . '@index');

});

Route::get('/', function () {
    return view('welcome');
});
