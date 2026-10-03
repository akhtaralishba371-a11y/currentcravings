<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\SiteContent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        $this->order->loadMissing('items');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation - '.$this->order->order_number
        );
    }

    public function content(): Content
    {
        $companyName = $this->safeSiteContent('hero_title_brand', config('app.name', 'Current Cravings'));
        $bakeryPhone = $this->safeSiteContent('contact_phone', '');
        $companyAddress = $this->safeSiteContent('contact_address', '');

        return new Content(
            view: 'emails.orders.customer-confirmation',
            with: [
                'companyName' => $companyName,
                'bakeryPhone' => $bakeryPhone,
                'companyAddress' => $companyAddress,
                'orderStatusUrl' => route('checkout.index'),
            ]
        );
    }

    private function safeSiteContent(string $key, string $default = ''): string
    {
        try {
            return SiteContent::get($key, $default);
        } catch (\Throwable) {
            return $default;
        }
    }

    public function attachments(): array
    {
        return [];
    }
}
