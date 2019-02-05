<?php

namespace App\Notifications\Incidents;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class IncidentReplyAdded.
 *
 * @package App\Notifications\Incidents
 */
class IncidentReplyAdded extends Notification implements ShouldQueue
{
    use Queueable;

    public $incident;

    /**
     * IncidentReplyAdded constructor.
     *
     * @param $incident
     */
    public function __construct($incident)
    {
        $this->incident = $incident;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'icon' => 'chat_bubble_outline',
            'title' => "S'ha afegit un comentari a una incidència",
            'subject' => $this->incident->subject,
            'id' => $this->incident->id,
        ];
    }
}
