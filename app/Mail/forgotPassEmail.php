<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forgotPassEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $code)
    {
        //
        $this->user  = $user;
        $this->code  = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user  = $this->user;
        $code  = $this->code;

        return $this->subject('TimKerjaKu Lupa Password.')
            ->view('template.forgot-password-mail', compact('user', 'code'));
    }
}
