<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $amount;

    public function __construct($otp, $amount)
    {
        $this->otp = $otp;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Withdraw request.')
                    ->markdown('mail.otpmail')
                    ->with('otp', $this->otp)->with('amount', $this->amount);
    }
}
