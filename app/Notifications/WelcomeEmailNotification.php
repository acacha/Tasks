<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class WelcomeEmailNotification.
 *
 * @package App\Notifications
 */
class WelcomeEmailNotification extends ResetPassword
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject("Benvingut a l'aplicació " . config('app.name'))
            ->greeting('Hola,')
            ->line("Us enviem aquest email perquè algú us ha convidat a utilitzar l'aplicació " . config('app.name') . ".")
            ->line("Per tal de poder utilitzar l'aplicació heu de crear una paraula de pas seguint el següent link:")
            ->action('Establir la paraula de pas', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Si vosté no està interessat en aquesta aplicació, si us plau ignoreu aquest email.')
            ->salutation('Salutacions,');
    }
}
