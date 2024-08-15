<?php

namespace App\Observers;

use App\Models\LectureCourse;
use Illuminate\Support\Facades\Auth;

class LectureCourseObserver
{

    public function creating(LectureCourse $lectureCourse):void
    {
        $lectureCourse->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $lectureCourse->admin_id = Auth::user()->id;
    }
    /**
     * Handle the LectureCourse "created" event.
     */
    public function created(LectureCourse $lectureCourse): void
    {
        //
    }

    /**
     * Handle the LectureCourse "updated" event.
     */
    public function updated(LectureCourse $lectureCourse): void
    {
        //
    }

    /**
     * Handle the LectureCourse "deleted" event.
     */
    public function deleted(LectureCourse $lectureCourse): void
    {
        //
    }

    /**
     * Handle the LectureCourse "restored" event.
     */
    public function restored(LectureCourse $lectureCourse): void
    {
        //
    }

    /**
     * Handle the LectureCourse "force deleted" event.
     */
    public function forceDeleted(LectureCourse $lectureCourse): void
    {
        //
    }
}
