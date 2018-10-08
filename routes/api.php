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

Route::get('/v1/tasks',function () {
    // Connectar-se obtenir tasques
//    return [
//      {
//          'name' => 'Compra pa',
//          'completed' => false
//      },
//      {
//        'name' => 'Compra llet',
//          'completed' => false
//      },
//      {
//        'name' => 'Compra pa',
//          'completed' => false
//      },
//    ];

      return Task::all();
});
