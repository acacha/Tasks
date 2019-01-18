<?php

namespace App\Http\Controllers\Api;


use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompletedTasksController
{
    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();

        // EXEMPLE COM NO FER
        Log::create([
            'text' => "S'ha marcat com a pendent la tasca 'comprar pa'",
            'time' => Carbon::now(),
            'action_type'=> 'descompletar',
            'module_type' => 'Tasques',
            'icon' => 'lock_open',
            'color' => 'primary',
            'user_id' => $request->user()->id,
            'loggable_id' => $task->id,
            'loggable_type' => Task::class,
            'old_value' => true,
            'new_value' => false
        ]);
    }

    public function store(Request $request, Task $task)
    {
        $task->completed=true;
        $task->save();
    }
}
