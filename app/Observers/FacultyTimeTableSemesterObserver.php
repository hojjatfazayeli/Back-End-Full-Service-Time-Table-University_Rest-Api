<?php

namespace App\Observers;

use App\Models\FacultyTimeTableSemester;
use Illuminate\Support\Facades\Auth;

class FacultyTimeTableSemesterObserver
{

    public function creating(FacultyTimeTableSemester $facultyTimeTableSemester):void
    {
        $facultyTimeTableSemester->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $facultyTimeTableSemester->admin_id = Auth::user()->id;
    }
    /**
     * Handle the FacultyTimeTableSemester "created" event.
     */
    public function created(FacultyTimeTableSemester $facultyTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the FacultyTimeTableSemester "updated" event.
     */
    public function updated(FacultyTimeTableSemester $facultyTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the FacultyTimeTableSemester "deleted" event.
     */
    public function deleted(FacultyTimeTableSemester $facultyTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the FacultyTimeTableSemester "restored" event.
     */
    public function restored(FacultyTimeTableSemester $facultyTimeTableSemester): void
    {
        //
    }

    /**
     * Handle the FacultyTimeTableSemester "force deleted" event.
     */
    public function forceDeleted(FacultyTimeTableSemester $facultyTimeTableSemester): void
    {
        //
    }
}
