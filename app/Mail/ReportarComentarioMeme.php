<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportarComentarioMeme extends Mailable
{
    use Queueable, SerializesModels;

    public $comentario;
    public $meme;
    public $memeId;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($comentario, $meme, $memeId, $url)
    {
        $this->comentario = $comentario;
        $this->meme = $meme;
        $this->memeId = $memeId;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Report comentário',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reportar-comentario-meme',
            with: [
                'comentario' => $this->comentario,
                'meme' => $this->meme,
                'memeId' => $this->memeId,
                'url' => $this->url,

            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
