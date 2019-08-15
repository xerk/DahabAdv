<?php

namespace App\Observers;

use App\Storage;

class OutofStockObserver
{
    /**
     * Handle the storage "created" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function created(Storage $storage)
    {
        //
    }

    /**
     * Handle the storage "updated" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function updated(Storage $storage)
    {
        //
    }

    /**
     * Handle the storage "deleted" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function deleted(Storage $storage)
    {
        //
    }

    /**
     * Handle the storage "restored" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function restored(Storage $storage)
    {
        //
    }

    /**
     * Handle the storage "force deleted" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function forceDeleted(Storage $storage)
    {
        //
    }
}
