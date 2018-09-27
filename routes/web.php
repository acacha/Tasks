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

// TDD -> TEST DRIVEN DEVELOPMENT


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


