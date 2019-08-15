<?php

namespace App\Observers;

use App\Storage;
use App\Mail\NewMaterialStock;
use Illuminate\Support\Facades\Mail;

class MaterialObserver
{
    /**
     * Handle the storage "created" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function creating(Storage $storage)
    {
        Mail::send(new NewMaterialStock($storage));
    }

    /**
     * Handle the storage "updated" event.
     *
     * @param  \App\Storage  $storage
     * @return void
     */
    public function updating(Storage $storage)
    {
        Mail::send(new NewMaterialStock($storage));
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
