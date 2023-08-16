<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayoutMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $payout;
    public $method_name;

    public function __construct($payout, $method_name)
    {
        $this->payout = $payout;
        $this->method_name = $method_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Withdraw mail from '.env('APP_NAME'))
                ->markdown('mail.payout-mail')
                ->with('payout', $this->payout)->with('method_name', $this->method_name);
    }
}
