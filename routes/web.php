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

use Illuminate\Support\Facades\Auth;

Auth::routes();

// TODO
Route::post('/login_alt','Auth\LoginAltController@login');

// TDD -> TEST DRIVEN DEVELOPMENT

Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store');
Route::delete('/tasks/{id}','TasksController@destroy');
Route::put('/tasks/{id}','TasksController@update');

//Route::get('/task_edit',function () {
//    return view('task_edit');
//});
Route::get('/task_edit/{id}','TasksController@edit');

// Route::resource() com alternativa


//Route::get('/tasks',function() {
//    return view('tasks');
//});


Route::get('/about',function () {
    return view('about');
});

Route::view('/contact', 'contact');

Route::get('/', function () {
    return view('welcome');
});



//Route::get('/prova','ProvaController@show');
Route::get('/prova',function() {
    $prova = 'asdasdasd';
    dd($prova);
});

Route::redirect('/hola','/prova');


//Complete
Route::post('/completed_task/{task}','CompletedTasksController@store');

//Uncomplete
Route::delete('/completed_task/{task}','CompletedTasksController@destroy');

//Route::get('/tasks_vue', function() {
//   echo 'hola';
//});
Route::get('/tasks_vue', 'TasksVueController@index');
Route::get('/home', 'TasksVueController@index');


// index -> LIST
// store -> create
// delete -> destory
// edit -> PUT
