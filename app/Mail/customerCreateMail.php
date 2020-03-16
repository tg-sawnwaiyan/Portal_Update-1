<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class customerCreateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $getComment;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($getComment)
    {
        $this->getComment = $getComment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(['mail.customerCreateMail','mail.customerCreateMailplaintext'])
                    ->subject("[TIS ティーズ]事業者の登録申請がありました。");
                    // ->subject("TIS ティーズに事業者の登録申請がありました。");
    }
}