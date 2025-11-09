<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use App\Models\Transaction;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $transaction;

    public function __construct(Invoice $invoice, Transaction $transaction)
    {
        $this->invoice = $invoice;
        $this->transaction = $transaction;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Successful - Invoice #' . $this->invoice->invoice_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-success',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}