<?php

namespace App\Http\Controllers\AdminPanel\Auto_Generate_Plan;

use App\Http\Controllers\Controller;
use App\Models\ClassRoomTimeTableSemester;
use App\Models\Lecture;

class AutoGeneratePlanController extends Controller
{
    public function getLectureList()
    {
        $lectureList = Lecture::all();
        return $lectureList;
    }

    public function getLectureSuggestTime($lectureId)
    {
        $lecture = Lecture::find($lectureId);
        $lectureSuggestTimes = $lecture->lecture_time_table;
        dd($lectureSuggestTimes);
    }

    public function autoGeneratePlan()
    {
        $lectureList = Lecture::all();
        foreach ($lectureList as $lecture)
        {
            $lectureSuggestTimes = $lecture->lecture_time_table;
            $lectureCourseList = $lecture->lecture_course;
            foreach ($lectureCourseList as $item)
            {
                $course = $item->course;
                foreach ($lectureSuggestTimes as $lectureSuggestTime)
                {
                    $mesureTime = $lectureSuggestTime->end_time - $lectureSuggestTime->start_time;
                    if ($mesureTime >= 4)
                    {
                       $classRoomTimeTable =  ClassRoomTimeTableSemester::Where('start_time',$lectureSuggestTime->start_time)->Where('day',$lectureSuggestTime->day)->first();
                       $classRoomTimeTable->update([
                           'lecture_course_id'=>$item->id,
                           'status'=>'full'
                       ]);
                       for($i=1 ; $i<=3 ; $i++)
                       {
                           $id = $classRoomTimeTable->id + $i;
                           $nextClassRoom = ClassRoomTimeTableSemester::find($id);
                           $nextClassRoom->update([
                               'lecture_course_id'=>$item->id,
                               'status'=>'full'
                           ]);

                       }
                        dd("ok");
                    }

                }
            }
        }
    }
}
