<?php

namespace App\Http\Controllers\Api;


use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController
{
    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();
    }

    public function store(Request $request, Task $task)
    {
        $task->completed=true;
        $task->save();
    }
}
