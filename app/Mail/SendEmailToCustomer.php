<?php

namespace App\Mail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;

    public function __construct(Order $order)
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
        return $this->view('website.email')
                    ->with([
                        'customerName' => $this->order->customer_name,
                        'customerPhone' => $this->order->customer_phone,
                        'customerAddress' => $this->order->customer_address,
                        'totalPrice'=> $this->order->total_price,
                        'note'=> $this->order->note,
                    ]);
    }
}
