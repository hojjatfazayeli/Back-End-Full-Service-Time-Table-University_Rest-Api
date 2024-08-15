<?php

namespace App\Observers;

use App\Models\Faculty;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

class FacultyObserver
{
    public function creating(Faculty $faculty):void
    {
        $faculty->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $faculty->admin_id = Auth::user()->id;
    }
    /**
     * Handle the Faculty "created" event.
     */
    public function created(Faculty $faculty): void
    {
        //
    }

    /**
     * Handle the Faculty "updated" event.
     */
    public function updated(Faculty $faculty): void
    {
        //
    }

    /**
     * Handle the Faculty "deleted" event.
     */
    public function deleted(Faculty $faculty): void
    {
        //
    }

    /**
     * Handle the Faculty "restored" event.
     */
    public function restored(Faculty $faculty): void
    {
        //
    }

    /**
     * Handle the Faculty "force deleted" event.
     */
    public function forceDeleted(Faculty $faculty): void
    {
        //
    }
}
