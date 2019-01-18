<?php

use App\Log;
use App\Mail\TaskUncompleted;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendMailTaskUncompletedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_uncompleted_mail_has_been_send()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        // Executar
//        event(new TaskUncompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskUncompleted();
        $listener->handle(new \App\Events\TaskUncompleted($task));
        // 3 ASSERT
        Mail::assertSent(TaskUncompleted::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                   $mail->hasTo($user->email) &&
                   $mail->hasCc(config('tasks.manager_email'));
        });
    }
}
