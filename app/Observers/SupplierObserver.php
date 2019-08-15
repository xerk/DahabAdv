<?php

namespace App\Observers;

use App\Supplier;

class SupplierObserver
{
    /**
     * Handle the supplier "created" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */
    public function creating(Supplier $supplier)
    {
        Mail::to($supplier)->send(new PaymentPlaced($payment));
    }

    /**
     * Handle the supplier "updated" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */
    public function updating(Supplier $supplier)
    {
        Mail::to($supplier)->send(new PaymentPlaced($payment));        
    }

    /**
     * Handle the supplier "deleted" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */
    public function deleted(Supplier $supplier)
    {
        //
    }

    /**
     * Handle the supplier "restored" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */
    public function restored(Supplier $supplier)
    {
        //
    }

    /**
     * Handle the supplier "force deleted" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */
    public function forceDeleted(Supplier $supplier)
    {
        //
    }
}
