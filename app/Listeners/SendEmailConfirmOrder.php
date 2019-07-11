<?php

namespace App\Listeners;
use Mail;
use App\Mail\SendEmailToCustomer;
use App\Events\CustomerOrdered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CustomerOrderd  $event
     * @return void
     */
    public function handle(CustomerOrdered $event)
    {
        $order = $event->order;
        Mail::to($order->customer_email)
                ->cc('buivansao.test@gmail.com')
                ->send(new SendEmailToCustomer($order));
    }
}
