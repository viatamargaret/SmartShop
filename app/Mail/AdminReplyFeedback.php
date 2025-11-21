<?php

namespace App\Mail;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReplyFeedback extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;
    public $reply;

    public function __construct(Feedback $feedback, $reply)
    {
        $this->feedback = $feedback;
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('Response to Your Feedback')
                    ->markdown('emails.feedback.reply');
    }
}
