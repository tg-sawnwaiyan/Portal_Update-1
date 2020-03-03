<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class deleteSentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $deleteMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($deleteMail)
    {
        $this->deleteMail = $deleteMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(['mail.deleteSentMail','mail.deleteSentMailplaintext'])
                    ->subject("delete mail");
    }
}