<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $checkmail;
    // public $testurlen;
    public function __construct($checkmail)
    {
        $this->checkmail = $checkmail;
        // $this->testurlen = md5($getEmail);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(['mail.resetMail','mail.resetMailPlainText'])
                    ->subject("[TIS ティーズ] パスワード再設定用のＵＲＬのお知らせ");
    }
}
