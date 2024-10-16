<?php

namespace App\Mail;

use App\Mail\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $imagePath = public_path('products/' . $order->product->images->first()->image);
        $imageData = base64_encode(file_get_contents($imagePath));
        $src = 'data: '.mime_content_type($imagePath).';base64,'.$imageData;

        return $this->subject('Your Invoice')
                    ->view('emails.invoice')
                    ->with(['imageSrc' => $src]);
    }

    public function testEmail()
{
    $imagePath = public_path('products/your_image.jpg');
    $imageData = base64_encode(file_get_contents($imagePath));
    $src = 'data: '.mime_content_type($imagePath).';base64,'.$imageData;

    Mail::raw('Test Email with Image', function($message) use ($src) {
        $message->to('test@example.com')
                ->subject('Test Email')
                ->setBody('<img src="'.$src.'" alt="Test Image">', 'text/html');
    });
}
}
