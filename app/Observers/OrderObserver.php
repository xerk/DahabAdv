<?php

namespace App\Observers;

use App\Order;
use App\Mail\OrderPlaced;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderObserver
{
    // use Queueable;
    /**
     * Handle the order "creating" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        $order->total = ($order->width * $order->height * $order->amount * $order->price_unit) / 10000;
        if ($order->client->email != null) {
            Mail::to($order->client)->send(new OrderPlaced($order));
        }
    }

    /**
     * Handle the order "updating" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updating(Order $order)
    {
        $order->total = ($order->width * $order->height * $order->amount * $order->price_unit) / 10000;
        if ($order->client->email != null) {
            // Mail::to($order->client)->send(new OrderPlaced($order));
        }

    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
