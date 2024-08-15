<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

class UniversityObserver
{
    public function creating(University $university):void
    {
        $university->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $university->admin_id = Auth::user()->id;
        $university->code = mt_rand('111111' , '999999');
    }
    /**
     * Handle the University "created" event.
     */
    public function created(University $university): void
    {
        //
    }

    /**
     * Handle the University "updated" event.
     */
    public function updated(University $university): void
    {
        //
    }

    /**
     * Handle the University "deleted" event.
     */
    public function deleted(University $university): void
    {
        //
    }

    /**
     * Handle the University "restored" event.
     */
    public function restored(University $university): void
    {
        //
    }

    /**
     * Handle the University "force deleted" event.
     */
    public function forceDeleted(University $university): void
    {
        //
    }
}
