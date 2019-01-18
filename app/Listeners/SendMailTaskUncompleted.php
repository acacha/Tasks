<?php

namespace App\Listeners;

use App\Mail\TaskUncompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailTaskUncompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->task->user())
            ->cc(config('tasks.manager_email'))
            ->send(new TaskUncompleted($event->task))
            ->subject($this->subject($event->task));
    }
}
