<?php

namespace App\Observers;

use App\Payment;
use App\Mail\PaymentPlaced;
use App\Notifications\PaymentNotify;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function creating(Payment $payment)
    {
        if ($payment->order->client->email != null) {
            $payment->order->client->notify(new PaymentNotify($payment));
        }
    }

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function updating(Payment $payment)
    {
        $payment->order->client->notify(new PaymentNotify($payment));
        if ($payment->order->client->email != null) {
        }
    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
