<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportarComentarioMeme extends Notification
{
    use Queueable;

    public $comentario;
    public $meme;
    public $memeId;

    /**
     * Create a new notification instance.
     */
    public function __construct($comentario, $meme, $memeId)
    {
        $this->comentario = $comentario;
        $this->meme = $meme;
        $this->memeId = $memeId;
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
                ->subject('Report de Comentário')
                ->line('O seguinte comentário foi reportardo: '. $this->comentario .'no meme: '. $this->meme)
                ->action('Segue o link do meme:', url('meme-especifico', ['id' => $memeId]))
                ->salutation();
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
