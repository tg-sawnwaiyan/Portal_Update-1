<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class nursingMailing extends Mailable
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
        return $this->view('mail.nursingMail')                    
                    ->subject("[医療介護ポータル] 医療介護ポータルより資料請求がありました");
                    // ->subject("医療介護ポータルより資料請求がありました");
    }
}