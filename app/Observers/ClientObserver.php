<?php

namespace App\Observers;

use App\Client;
use App\Mail\NewClientMail;
use Illuminate\Bus\Queueable;
use App\Notifications\NewClient;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientObserver
{
    /**
     * Handle the client "created" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function creating(Client $client)
    {
        if ($client->email != null) {
            $client->notify(new NewClient($client));
        }
    }

    /**
     * Handle the Client "updating" event.
     *
     * @param  \App\Client  $Client
     * @return void
     */
    public function updating(Client $client)
    {
        //
    }

    /**
     * Handle the Client "updating" event.
     *
     * @param  \App\Client  $Client
     * @return void
     */
    public function saved(Client $client)
    {
        //
    }


    /**
     * Handle the client "deleted" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        //
    }

    /**
     * Handle the client "restored" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
