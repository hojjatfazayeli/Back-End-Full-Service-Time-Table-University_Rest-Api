<?php

namespace App\Http\Controllers\AdminPanel\ClassRoom_TimeTable_Semester;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomTimeTableSemesterUpdateRequest;
use App\Http\Resources\ClassRoomTimeTableSemesterResource;
use App\Http\Resources\ReportResource;
use App\Models\ClassRoom;
use App\Models\ClassRoomTimeTableSemester;
use App\Models\FacultyTimeTableSemester;
use App\Models\ReportSystem;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ClassRoomTimeTableSemesterController extends Controller
{
    public function index(Request $request)
    {
        $class_room_time_table_semester = ClassRoomTimeTableSemester::query();
        if ($request->has('orderby')) {
            $class_room_time_table_semester = $class_room_time_table_semester->orderBy('id', $request->orderby);
        }
        if ($request->has('university_id')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('university_id', $request->university_id);
        }
        if ($request->has('faculty_id')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('semester_id')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('semester_id', $request->semester_id);
        }
        if ($request->has('class_room_id')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('class_room_id', $request->class_room_id);
        }
        if ($request->has('lecture_course_id')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('lecture_course_id', $request->lecture_course_id);
        }
        if ($request->has('admin_id')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('admin_id', $request->admin_id);
        }
        if ($request->has('start_time')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('start_time', $request->start_time);
        }
        if ($request->has('end_time')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('end_time', $request->end_time);
        }
        if ($request->has('day')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('day', $request->day);
        }
        if ($request->has('status')) {
            $class_room_time_table_semester = $class_room_time_table_semester->where('status', $request->status);
        }

        if ($request->has('perpage')) {
            $class_room_time_table_semester = $class_room_time_table_semester->paginate($request->perpage);
            $report = 'no';

        } else {
            $class_room_time_table_semester = $class_room_time_table_semester->get();
            $report = $this->reportLog('لیست زمانبندی ترم کلاس های داشنکده');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست زمانبندی ترم کلاس های دانشگده با موفقیت دریافت شد',
            "report" => $report,
            "data" => ClassRoomTimeTableSemesterResource::collection($class_room_time_table_semester)->response()->getData()
        ], 200);
    }

    public function generate(Semester $semester)
    {
        $faculty_time_table_semester = $semester->faculty_time_table_semester;
        $faculty_class_room = ClassRoom::where('faculty_id' , $semester->faculty->id)->get();

                foreach ($faculty_time_table_semester as $key => $item)
                {
                    foreach ($faculty_class_room as $key => $value)
                    {
                        ClassRoomTimeTableSemester::create(
                            [
                                'week' => $item->week,
                                'day' => $item->day,
                                'code' => $item->code,
                                'start_time' => $item->start_time,
                                'end_time' => $item->end_time,
                                'university_id' => $item->university_id,
                                'faculty_id' => $item->faculty_id,
                                'semester_id' => $item->semester_id,
                                'class_room_id' => $value->id,
                            ]
                        );
                    }
                }

        return response()->json([
            "message" => 'زمانبندی ترم کلاس های دانشکده باموفقیت انجام شد',
            "data" => ClassRoomTimeTableSemesterResource::collection($semester->class_room_time_table_semester)->response()->getData()
        ], 200);
    }

    public function show(ClassRoomTimeTableSemester $classRoomTimeTableSemester)
    {
        return response()->json([
            "message" => 'زمانبندی موردنظر باموفقیت انجام شد',
            "data" => new ClassRoomTimeTableSemesterResource($classRoomTimeTableSemester)
        ], 200);
    }

    public function update(ClassRoomTimeTableSemesterUpdateRequest $classRoomTimeTableSemesterUpdateRequest , ClassRoomTimeTableSemester $classRoomTimeTableSemester)
    {
        $classRoomTimeTableSemester->update($classRoomTimeTableSemesterUpdateRequest->all());
        return response()->json([
            "message" => 'زمانبندی موردنظر باموفقیت بروزرسانی شد',
            "data" => new ClassRoomTimeTableSemesterResource($classRoomTimeTableSemester)
        ], 200);
    }

    public function autoDestroy(Request $request)
    {
        $item = ClassRoomTimeTableSemester::find($request->item);
        $item ? $item->delete(): false;
        return response()->json([
            "message" => 'حذف با موفقیت انجام شد',
        ], 200);
    }

    public function reportLog($reportname)
    {
        $currentTime = Carbon::now();
        $time = $currentTime->format('H:i:s');
        $date = $currentTime->format('Y-m-d');
        $reportData =  ReportSystem::create([
            'uuid'=>Uuid::generate()->string,
            'type'=>$reportname,
            'receiver_report_id'=>Auth::user()->id,
            'role'=>'admin',
            'data'=>$date,
            'time'=>$time,
            'row'=>mt_rand('11111','99999')
        ]);

        return $reportData;
    }


}
