<?php

namespace App\Observers;

use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;

class LectureObserver
{
    public function creating(Lecture $lecture):void
    {
        $lecture->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $lecture->admin_id = Auth::user()->id;
    }
    /**
     * Handle the Lecture "created" event.
     */
    public function created(Lecture $lecture): void
    {
        //
    }

    /**
     * Handle the Lecture "updated" event.
     */
    public function updated(Lecture $lecture): void
    {
        //
    }

    /**
     * Handle the Lecture "deleted" event.
     */
    public function deleted(Lecture $lecture): void
    {
        //
    }

    /**
     * Handle the Lecture "restored" event.
     */
    public function restored(Lecture $lecture): void
    {
        //
    }

    /**
     * Handle the Lecture "force deleted" event.
     */
    public function forceDeleted(Lecture $lecture): void
    {
        //
    }
}
