<?php

namespace App\Observers;

use App\Models\Landlord;
use App\Models\User;

class LandlordObserver
{
    /**
     * Handle the Landlord "creating" event.
     */
    public function creating(Landlord $landlord): void
    {

        if (request()->has('user')) {

            $landlord->user()->create(request()->user);
        }
    }

    /**
     * Handle the Landlord "updated" event.
     */
    public function updated(Landlord $landlord): void
    {
        //
    }

    /**
     * Handle the Landlord "deleted" event.
     */
    public function deleted(Landlord $landlord): void
    {
        //
    }

    /**
     * Handle the Landlord "restored" event.
     */
    public function restored(Landlord $landlord): void
    {
        //
    }

    /**
     * Handle the Landlord "force deleted" event.
     */
    public function forceDeleted(Landlord $landlord): void
    {
        //
    }
}
