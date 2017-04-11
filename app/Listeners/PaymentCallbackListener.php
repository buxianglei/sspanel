<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentCallbackListener
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
     * @param  PaymentEvent  $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
        dump($event);
    }
}
