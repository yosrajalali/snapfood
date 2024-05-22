<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, $status)
    {
        $this->comment = $comment;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Comment Status Mail',
        );
    }

    public function build()
    {
        return $this->subject('تغییر وضعیت نظر')
            ->view('seller.email.comment-status')
            ->with([
                'comment' => $this->comment,
                'status' => $this->status,
            ]);
    }

    /**
     * Get the message content definition.
     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }

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
