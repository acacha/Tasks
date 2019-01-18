<?php

use App\Log;
use App\Mail\TaskUncompleted;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTaskUncompletedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_uncompleted_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));

        $listener = new \App\Listeners\LogTaskUncompleted();
        $listener->handle(new \App\Events\TaskUncompleted($task));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha marcat com a pendent la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'descompletar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,true);
        $this->assertEquals($log->new_value,0);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'lock_open');
        $this->assertEquals($log->color,'primary');
    }
}
