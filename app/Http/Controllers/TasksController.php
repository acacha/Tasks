<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at','desc')->get();
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

    public function update(Request $request)
    {
//        dd($request->id);
        // Models -> Eloquent -> ORM (HIBERNATE de Java) Object Relation Model
//        dd(Task::find($request->id));

//        if (!Task::find($request->id)) return response(404,'No he trobat');
        $task = Task::findOrFail($request->id);

        $task->name = $request->name;
        $task->completed = true;
        $task->save();
        return redirect('/tasks');
    }

    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);
//        return view('task_edit',compact('task'));
    }


}

//class CompletedTaskController {
//    // Complete
//    public function store()
//    {
//
//    }
//
//    // Uncomplete
//    public function delete()
//    {
//
//    }
//}
