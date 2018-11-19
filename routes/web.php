<?php

use Illuminate\Support\Facades\Auth;

Auth::routes();

// TODO
Route::post('/login_alt','Auth\LoginAltController@login');

// TDD -> TEST DRIVEN DEVELOPMENT

// MIDDLEWARE

//GRUP DE URLS PER USUARIS AUTENTICATS
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks','TasksController@index');
    Route::post('/tasks','TasksController@store');
    Route::delete('/tasks/{id}','TasksController@destroy');
    Route::put('/tasks/{id}','TasksController@update');

    Route::get('/task_edit/{id}','TasksController@edit');

    Route::get('/about',function () {
        return view('about');
    });

    Route::view('/contact', 'contact');

    //Complete
    Route::post('/completed_task/{task}','CompletedTasksController@store');

    //Uncomplete
    Route::delete('/completed_task/{task}','CompletedTasksController@destroy');

    Route::get('/tasks_vue', 'TasksVueController@index');
    Route::get('/tasques', 'TasquesController@index');
    Route::get('/home', 'TasksVueController@index');

    // USER TASKS
    Route::get('/user/tasks','LoggedUserTasksController@index');

    Route::impersonate();

});

Route::get('/', function () {
    return view('welcome');
});
