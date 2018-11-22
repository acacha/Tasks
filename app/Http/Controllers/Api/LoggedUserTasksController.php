<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index(Request $request)
    {
        return map_collection($request->user()->tasks);
    }

    public function store(Request $request)
    {
        $task = Request::create($request->only(['name','completed']));
        return Auth::user()->addTask($task);
    }

    /**
     * update.
     * @param Request $request
     * @param Task $task
     * @return Task
     */
    public function update(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = $request->completed;
        $task->save();
        return $task;
    }

    public function destroy(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->delete();
//        $user->removeTask(); // Contrari addTask
    }
}
