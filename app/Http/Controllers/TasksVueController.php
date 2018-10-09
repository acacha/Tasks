<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksVueController extends Controller
{
    public function index()
    {
        // MVC
//        $tasks = Task::all();
        $tasks = null;
//        return view('tasks_vue',[
//            'tasks' => $tasks
//        ]);
        return view('tasks_vue',
            compact('tasks'));
    }
}
