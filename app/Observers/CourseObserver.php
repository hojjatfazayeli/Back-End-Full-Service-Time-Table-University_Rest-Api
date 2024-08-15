<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\ScientificGroup;
use Illuminate\Support\Facades\Auth;

class CourseObserver
{
    public function creating(Course $course):void
    {
        $course->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $course->admin_id = Auth::user()->id;
    }
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
