<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TasksStore;
use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksUpdate;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return map_collection(User::all());
    }
}
