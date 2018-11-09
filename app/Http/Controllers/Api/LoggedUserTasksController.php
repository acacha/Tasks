<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index()
    {
//        return Task::all();
//        return Task::where('user_id',Auth::user()->id);
//        $statement = 'SELECT * FROM user WHERE user_id=' . Auth::user()->id;
//        $result = DB:getConnection('sqlite')->exec($statement);
//        asdas
        return Auth::user()->tasks;
    }

    public function store(Request $request)
    {
//        return Auth::user()->tasks;
//        Request::create([
//            'name' => $request->name,
//            'completed' => $request->completed
//        ]);
        $task = Request::create($request->only(['name','completed']));
//        return Auth::user()->tasks->save($task);
        return Auth::user()->addTask($task);
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return Auth::user()->removeTask($task);
    }

    public function update(Request $request, Task $task)
    {
//        findOrFail
        Auth::user()->tasks()->findOrFail($task->id);
//        Tasks:all()->findOrFail($task->id);
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->save();

//        if (Auth::user()->haveTask($task)) {
//            $task->name = $request->name;
//            $task->completed = $request->completed;
//            $task->save();
//        }
    }
}
