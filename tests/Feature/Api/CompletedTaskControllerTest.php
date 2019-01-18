<?php

namespace Tests\Feature\Api;

use App\Log;
use App\Mail\TaskUncompleted;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class CompletedTaskControllerTest extends TestCase {
    use RefreshDatabase,CanLogin;

    /**
     * @test
     */
    public function can_complete_a_task()
    {
        $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        $response = $this->json('POST','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals($task->completed, true);
    }

    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $this->login('api');
        $response = $this->json('POST','/api/v1/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        $user = $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2
        Mail::fake();
        $response = $this->json('DELETE','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals((boolean) $task->completed, false);

        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha marcat com a pendent la tasca 'comprar pa'");
        $this->assertEquals($log->action_type,'descompletar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,true);
        $this->assertEquals($log->new_value,0);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'lock_open');
        $this->assertEquals($log->color,'primary');

        // Comprovar enviament Email
        Mail::assertSent(TaskUncompleted::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                   $mail->hasTo($user->email) &&
                   $mail->hasCc(config('tasks.manager_email'));
        });
    }

    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        $this->login('api');
        $response= $this->delete('/api/v1/completed_task/1');
        $response->assertStatus(404);
    }
}
