<?php

namespace App\Mail;

use PDF;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrxReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $logs;
    public $general;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($general, $data)
    {
        $this->data = $data;
        $this->logs = Transaction::where('user_id', auth()->id())->latest()->get();
        $this->general = $general;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView('mails.statement', ['logs' => $this->logs]);

        return $this->from($this->general->email_from, $this->general->sitename)
            ->subject($this->data["pageTitle"])
            ->view('mails.trx_report')
            ->attachData($pdf->output(), "report.pdf");
    }
}
