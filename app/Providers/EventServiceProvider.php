<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\ClassRoom;
use App\Models\ClassRoomTimeTableSemester;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\FacultyTimeTableSemester;
use App\Models\Lecture;
use App\Models\LectureCourse;
use App\Models\LectureTimeTable;
use App\Models\ScientificGroup;
use App\Models\Semester;
use App\Models\University;
use App\Observers\AdminObserver;
use App\Observers\ClassRoomObserver;
use App\Observers\ClassRoomTimeTableSemesterObserver;
use App\Observers\CourseObserver;
use App\Observers\FacultyObserver;
use App\Observers\FacultyTimeTableSemesterObserver;
use App\Observers\LectureCourseObserver;
use App\Observers\LectureObserver;
use App\Observers\LectureTimeTableObserver;
use App\Observers\ScientificGroupObserver;
use App\Observers\SemesterObserver;
use App\Observers\UniversityObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Admin::observe(AdminObserver::class);
        University::observe(UniversityObserver::class);
        Faculty::observe(FacultyObserver::class);
        ClassRoom::observe(ClassRoomObserver::class);
        ScientificGroup::observe(ScientificGroupObserver::class);
        Course::observe(CourseObserver::class);
        Lecture::observe(LectureObserver::class);
        Semester::observe(SemesterObserver::class);
        LectureCourse::observe(LectureCourseObserver::class);
        LectureTimeTable::observe(LectureTimeTableObserver::class);
        FacultyTimeTableSemester::observe(FacultyTimeTableSemesterObserver::class);
        ClassRoomTimeTableSemester::observe(ClassRoomTimeTableSemesterObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
