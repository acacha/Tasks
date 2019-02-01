<?php

namespace App\Events;

use App\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;

    public $name;
    public $completed;
    public $loquesigui;
    public $loquesigui1;
    public $loquesigui2;
    public $loquesigui3;
    public $loquesigui4;
    public $loquesigui5;

    /**
     * TaskDeleted constructor.
     * @param $task
     */
    public function __construct(array $oldTask, array $newTasK)
    {
        $this->task = $task;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
