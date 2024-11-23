<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {

        return $this->view('emails.invoice')
                    ->subject('შეკვეთის ინვოისი')
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}
