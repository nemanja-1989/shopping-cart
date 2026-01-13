<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class LowStockMail extends Mailable
{
    public Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the message envelope.
     */
     public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Low Stock Alert'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.low-stock', // your markdown blade view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
