<?php

namespace App\Observers;

use App\Models\ClassRoom;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;

class ClassRoomObserver
{
    public function creating(ClassRoom $classRoom):void
    {
        $classRoom->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $classRoom->admin_id = Auth::user()->id;
    }
    /**
     * Handle the ClassRoom "created" event.
     */
    public function created(ClassRoom $classRoom): void
    {
        //
    }

    /**
     * Handle the ClassRoom "updated" event.
     */
    public function updated(ClassRoom $classRoom): void
    {
        //
    }

    /**
     * Handle the ClassRoom "deleted" event.
     */
    public function deleted(ClassRoom $classRoom): void
    {
        //
    }

    /**
     * Handle the ClassRoom "restored" event.
     */
    public function restored(ClassRoom $classRoom): void
    {
        //
    }

    /**
     * Handle the ClassRoom "force deleted" event.
     */
    public function forceDeleted(ClassRoom $classRoom): void
    {
        //
    }
}
