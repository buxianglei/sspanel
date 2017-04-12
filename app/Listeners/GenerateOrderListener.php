<?php

namespace App\Listeners;

use App\Events\GenerateOrderEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Order;
use App\Models\Plan;
use Carbon\Carbon;

class GenerateOrderListener implements ShouldQueue
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
     * @param  GenerateOrderEvent  $event
     * @return void
     */
    public function handle(GenerateOrderEvent $event)
    {
        $plan = Plan::where('id', $event->plan_id)->first();

        if (empty($plan)) {
            return false;
        }

        $plan_price = $plan->price;

        $userAccount = $event->user->userAccount;

        if ($userAccount->amount - $plan_price < 0) {
            return $false;
        }

        $rsp = $userAccount->decrement('amount', $plan_price);

        if (empty($rsp)) {
            return false;
        }

        $order = new Order();
        $order->plan_id = $event->plan_id;
        $order->expire_time = Carbon::now()->addDays($plan->vaild_time);

        $result = $event->user->order()->save($order);
        return $result;
    }
}
