<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskUncompleted;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController
{
    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();
        // HOOK -> EVENT
        event(new TaskUncompleted($task));
    }

    protected function subject($task)
    {
        return ellipsis('Tasca pendent (' . $task->id . '): ' . $task->name, 80);
    }

    public function store(Request $request, Task $task)
    {
        $task->completed=true;
        $task->save();
    }
}
