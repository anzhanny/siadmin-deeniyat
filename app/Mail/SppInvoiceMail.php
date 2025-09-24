<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SppInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Tagihan SPP {$this->payment->month} {$this->payment->year}",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.spp_invoice',
            with: [
                'payment' => $this->payment,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
