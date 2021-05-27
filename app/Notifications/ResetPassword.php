<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class ResetPassword extends Notification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)

            ->line('Bu e-postayı, hesabınız için bir şifre sıfırlama isteğinde bulunduğunuz için size ilettik.')
            ->subject('Parola Sıfırlama')

            ->action('Şifreyi Sıfırla', url(config('app.url').'/password/reset/'.$this->token).'?email='.urlencode($notifiable->email))
            ->line('Parola sıfırlama talebinde bulunmadıysanız, başka bir işlem yapmanıza gerek yok.');
    }
}
