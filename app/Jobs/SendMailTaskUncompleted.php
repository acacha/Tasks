<?php

namespace App\Jobs;

use App\Mail\TaskUncompleted;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMailTaskUncompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $task;

    /**
     * SendMailTaskUncompleted constructor.
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subject = $this->task->subject();
        Mail::to($this->task->user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskUncompleted($this-->task))->subject($subject));
    }
}
