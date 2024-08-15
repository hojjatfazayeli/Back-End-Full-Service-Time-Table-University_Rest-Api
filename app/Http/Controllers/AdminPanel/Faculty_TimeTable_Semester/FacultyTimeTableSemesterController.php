<?php

namespace App\Http\Controllers\AdminPanel\Faculty_TimeTable_Semester;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyTimeTableUpdateRequest;
use App\Http\Resources\FacultyTimeTableSemesterResource;
use App\Http\Resources\ReportResource;
use App\Models\FacultyTimeTableSemester;
use App\Models\ReportSystem;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class FacultyTimeTableSemesterController extends Controller
{

    public function index(Request $request)
    {
        $faculty_time_table_semester = FacultyTimeTableSemester::query();
        if ($request->has('orderby')) {
            $faculty_time_table_semester = $faculty_time_table_semester->orderBy('id', $request->orderby);
        }
        if ($request->has('university_id')) {
            $faculty_time_table_semester = $faculty_time_table_semester->where('university_id', $request->university_id);
        }
        if ($request->has('faculty_id')) {
            $faculty_time_table_semester = $faculty_time_table_semester->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('semester_id')) {
            $faculty_time_table_semester = $faculty_time_table_semester->where('semester_id', $request->semester_id);
        }
        if ($request->has('admin_id')) {
            $faculty_time_table_semester = $faculty_time_table_semester->where('admin_id', $request->admin_id);
        }
        if ($request->has('start_time')) {
            $faculty_time_table_semester = $faculty_time_table_semester->where('start_time', $request->start_time);
        }
        if ($request->has('end_time')) {
            $faculty_time_table_semester = $faculty_time_table_semester->where('end_time', $request->end_time);
        }
        if ($request->has('perpage')) {
            $faculty_time_table_semester = $faculty_time_table_semester->paginate($request->perpage);
            $report = 'no';

        } else {
            $faculty_time_table_semester = $faculty_time_table_semester->get();
            $report = $this->reportLog('لیست زمانبندی ترم داشنکده');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست زمانبندی ترم دانشگده با موفقیت دریافت شد',
            "report" => $report,
            "data" => FacultyTimeTableSemesterResource::collection($faculty_time_table_semester)->response()->getData()
        ], 200);
    }

    public function generate(Semester $semester)
    {
        $weeks = [1,2];
        $days = [1,2,3,4,5,6,7];
        $diffrence_time = $semester->end_time - $semester->start_time;
        foreach ($weeks as $key => $week)
        {
            foreach ($days as $key => $day)
            {
                for ($i = 1 ; $i<= $diffrence_time ; $i++)
                {
                    FacultyTimeTableSemester::create(
                        [
                            'week' => $week,
                            'day' => $day,
                            'code' => $i,
                            'start_time' => ($semester->start_time +$i) - 1,
                            'end_time' => $semester->start_time +$i,
                            'university_id' => $semester->university_id,
                            'faculty_id' => $semester->faculty_id,
                            'semester_id' => $semester->id,
                        ]
                    );
                }
            }
        }

        return response()->json([
            "message" => 'زمانبندی ترم دانشکده باموفقیت انجام شد',
            "data" => FacultyTimeTableSemesterResource::collection($semester->faculty_time_table_semester)->response()->getData()
        ], 200);
    }

    public function show(FacultyTimeTableSemester $facultyTimeTableSemester)
    {
        return response()->json([
            "message" => 'اطلاعات زمانبدی با موفقیت دریافت شد ',
            "data" => new FacultyTimeTableSemesterResource($facultyTimeTableSemester)
        ], 200);
    }

    public function update(FacultyTimeTableUpdateRequest $facultyTimeTableUpdateRequest , FacultyTimeTableSemester $facultyTimeTableSemester)
    {
        $facultyTimeTableSemester->update($facultyTimeTableUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات زمانبدی با موفقیت بروزرسانی شد ',
            "data" => new FacultyTimeTableSemesterResource($facultyTimeTableSemester)
        ], 200);
    }

    public function autoDestroy(Request $request)
    {
        $item = FacultyTimeTableSemester::find($request->item);
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
