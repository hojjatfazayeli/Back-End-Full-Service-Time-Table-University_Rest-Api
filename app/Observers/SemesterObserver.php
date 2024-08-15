<?php

namespace App\Observers;

use App\Models\Semester;
use Illuminate\Support\Facades\Auth;

class SemesterObserver
{
    public function creating(Semester $semester):void
    {
        $semester->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $semester->admin_id = Auth::user()->id;
    }
    /**
     * Handle the Semester "created" event.
     */
    public function created(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "updated" event.
     */
    public function updated(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "deleted" event.
     */
    public function deleted(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "restored" event.
     */
    public function restored(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "force deleted" event.
     */
    public function forceDeleted(Semester $semester): void
    {
        //
    }
}
