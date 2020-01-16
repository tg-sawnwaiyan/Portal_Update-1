<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class adminNursingMail extends Mailable
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
        return $this->view('mail.adminNursingMail')
                    ->subject("[T-IS ティーズ] 資料請求がありました");
                    // ->subject("T-IS ティーズより資料請求がございました");
    }
}