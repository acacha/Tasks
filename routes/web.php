<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\LoggedUserTasksController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasquesController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\UserPhotoController;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::bind('hashuser', function($value, $route)
{
    $hashids = new Hashids\Hashids(config('scool.salt'));
    $id = $hashids->decode($value)[0];

    return User::findOrFail($id);
});

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

    Route::get('/profile', '\\'. ProfileController::class . '@show');


    Route::post('/photo', '\\'. PhotoController::class . '@store');


    Route::get('/user/photo', '\\'. LoggedUserPhotoController::class . '@show');
//    Route::post('/avatar', '\\'. AvatarController::class . '@store');

    //Changelog
    Route::get('/changelog','\\'. ChangelogController::class . '@index');
//    Route::get('/changelog/module/{module}','Tenant\Web\ChangelogModuleController@index');
//    Route::get('/changelog/user/{user}','Tenant\Web\ChangelogUserController@index');
//    Route::get('/changelog/loggable/{loggable}/{loggableId}','Tenant\Web\ChangelogLoggableController@index');

    Route::get('/notifications', '\\' . NotificationController::class . '@index');

    // User photos
    Route::get('/user/{hashuser}/photo','\\' . UserPhotoController::class . '@show')->name('user.photo.show');
    Route::get('/user/{hashuser}/photo/download', '\\' . UserPhotoController::class . '@download')->name('user.photo.download');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/{provider}', '\\'. LoginController::class . '@redirectToProvider');
Route::get('/auth/{provider}/callback', '\\'. LoginController::class . '@handleProviderCallback');

Route::get('/prova_cua', function () {
    dump('SHIt!');
   \App\Jobs\SleepJob::dispatch();
});

Route::get('/omplir', function () {
    // 10 000
    for ($i = 1; $i <= 10000; $i++) {
        Task::create([
           'name' => 'Prova'
        ]);
    }
});
