<?php

namespace App\Observers;

use App\Models\ClassRoomTimeTableSemester;
use Illuminate\Support\Facades\Auth;

class ClassRoomTimeTableSemesterObserver
{
    public function creating(ClassRoomTimeTableSemester $classRoomTimeTableSemester):void
    {
        $classRoomTimeTableSemester->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $classRoomTimeTableSemester->admin_id = Auth::user()->id;
    }
    /**
     * Handle the ClassRoomTimeTableSemester "created" event.
     */
    public function created(ClassRoomTimeTableSemester $classRoomTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the ClassRoomTimeTableSemester "updated" event.
     */
    public function updated(ClassRoomTimeTableSemester $classRoomTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the ClassRoomTimeTableSemester "deleted" event.
     */
    public function deleted(ClassRoomTimeTableSemester $classRoomTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the ClassRoomTimeTableSemester "restored" event.
     */
    public function restored(ClassRoomTimeTableSemester $classRoomTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the ClassRoomTimeTableSemester "force deleted" event.
     */
    public function forceDeleted(ClassRoomTimeTableSemester $classRoomTimeTableSemester): void
    {
        //
    }
}
