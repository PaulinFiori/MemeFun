<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RepotarComentarioPost extends Mailable
{
    use Queueable, SerializesModels;

    public $comentario;
    public $post;
    public $postId;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($comentario, $post, $postId, $url)
    {
        $this->comentario = $comentario;
        $this->post = $post;
        $this->postId = $postId;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Repotar Comentario Post',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reportar-comentario-post',
            with: [
                'comentario' => $this->comentario,
                'post' => $this->post,
                'postId' => $this->postId,
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
