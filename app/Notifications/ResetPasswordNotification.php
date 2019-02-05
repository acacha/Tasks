<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ResetPasswordNotification.
 *
 * @package App\Notifications
 */
class ResetPasswordNotification extends ResetPassword
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
            ->subject('Notificació de restauració de la paraula de pas')
            ->greeting('Hola,')
            ->line('Us enviem aquest email perquè algú (probablement vosté) ha demanat una petició de restauració de la paraula de pas.')
            ->action('Restaurar paraula de pas', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Si vosté no ha realitzat aquesta petició, si us plau ignoreu aquest email.')
            ->salutation('Salutacions,');
    }
}
