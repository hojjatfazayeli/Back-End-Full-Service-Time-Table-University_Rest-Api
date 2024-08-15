<?php

namespace App\Observers;

use App\Models\LectureTimeTable;
use Illuminate\Support\Facades\Auth;

class LectureTimeTableObserver
{

    public function creating(LectureTimeTable $lectureTimeTable):void
    {
        $lectureTimeTable->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $lectureTimeTable->admin_id = Auth::user()->id;
    }
    /**
     * Handle the LectureTimeTable "created" event.
     */
    public function created(LectureTimeTable $lectureTimeTable): void
    {
        //
    }

    /**
     * Handle the LectureTimeTable "updated" event.
     */
    public function updated(LectureTimeTable $lectureTimeTable): void
    {
        //
    }

    /**
     * Handle the LectureTimeTable "deleted" event.
     */
    public function deleted(LectureTimeTable $lectureTimeTable): void
    {
        //
    }

    /**
     * Handle the LectureTimeTable "restored" event.
     */
    public function restored(LectureTimeTable $lectureTimeTable): void
    {
        //
    }

    /**
     * Handle the LectureTimeTable "force deleted" event.
     */
    public function forceDeleted(LectureTimeTable $lectureTimeTable): void
    {
        //
    }
}
