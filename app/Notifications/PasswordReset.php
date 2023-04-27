<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    public $token;
    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $name)
    {
        $this->token = $token;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Resete de senha')
                    ->greeting('Olá, ' . $this->name)
                    ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
                    ->action('Resetar senha',  url('password/reset', $this->token))
                    ->line('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.')
                    ->salutation('Agradecimentos, ' . config('app.name') );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
