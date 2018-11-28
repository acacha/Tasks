<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTasksIndex;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;

class TasquesController extends Controller
{
    public function index(UserTasksIndex $request)
    {
        $tasks = [];
        if (Auth::user()->isSuperAdmin() || Auth::user()->hasRole('TaskManager')) {
            $tasks =  map_collection(Task::orderBy('created_at','desc')->get());
        } else {
            $tasks =  map_collection($request->user()->tasks);
        }
        $users = User::all();
        return view('tasques',compact('tasks','users'));
    }
}
