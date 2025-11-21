<?php

namespace App\Mail;

use App\Models\ChatbotMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReply extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;
    public $reply;

    public function __construct(ChatbotMessage $messageData, $reply)
    {
        $this->messageData = $messageData;
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('Reply from Admin')
                    ->view('emails.admin_reply'); // make sure this view exists
    }
}
