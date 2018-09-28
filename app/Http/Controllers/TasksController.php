<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks',['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
//        dd(Request::input());
        // Request::
//        https://laravel.com/docs/5.7/requests
        Task::create([
            'name' => $request->name,
            'completed' => false
        ]);

        // Retornar a /tasks
        return redirect('/tasks');
    }

    public function destroy(Request $request)
    {
//        dd($request->id);
        $task = Task::findOrFail($request->id);
        $task->delete();
        // Retornar a /tasks
        return redirect()->back();
    }
}
