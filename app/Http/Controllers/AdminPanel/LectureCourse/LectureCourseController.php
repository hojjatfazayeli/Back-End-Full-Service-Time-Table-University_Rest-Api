<?php

namespace App\Http\Controllers\AdminPanel\LectureCourse;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureCourseStoreRequest;
use App\Http\Requests\LectureCourseUpdateRequest;
use App\Http\Resources\LectureCourseInfoResourse;
use App\Http\Resources\ReportResource;
use App\Models\LectureCourse;
use App\Models\ReportSystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class LectureCourseController extends Controller
{
    public function index(Request $request)
    {
        $lecture_course = LectureCourse::query();
        if ($request->has('orderby')) {
            $lecture_course = $lecture_course->orderBy('id', $request->orderby);
        }
        if ($request->has('university_id')) {
            $lecture_course = $lecture_course->where('university_id', $request->university_id);
        }
        if ($request->has('faculty_id')) {
            $lecture_course = $lecture_course->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('scientific_group_id')) {
            $lecture_course = $lecture_course->where('scientific_group_id', $request->scientific_group_id);
        }
        if ($request->has('semester_id')) {
            $lecture_course = $lecture_course->where('semester_id', $request->semester_id);
        }
        if ($request->has('lecture_id')) {
            $lecture_course = $lecture_course->where('lecture_id', $request->lecture_id);
        }
        if ($request->has('course_id')) {
            $lecture_course = $lecture_course->where('course_id', $request->course_id);
        }
        if ($request->has('perpage')) {
            $lecture_course = $lecture_course->paginate($request->perpage);
            $report = 'no';

        } else {
            $lecture_course = $lecture_course->get();
            $report = $this->reportLog('لیست دروس اختصاص داده شده');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست دروس اختصاص داده شده با موفقیت دریافت شد',
            "report" => $report,
            "data" => LectureCourseInfoResourse::collection($lecture_course)->response()->getData()
        ], 200);
    }
    public function store(LectureCourseStoreRequest $lectureCourseStoreRequest)
    {
        $lecture_course = LectureCourse::create($lectureCourseStoreRequest->all());
        return response()->json([
            "message" => 'اختصاص درس با موفقیت ایجاد شد',
            "data" => new LectureCourseInfoResourse($lecture_course)
        ], 200);
    }
    public function show(LectureCourse $lectureCourse)
    {
        return response()->json([
            "message" => 'اطلاعات اختصاص درس با موفقیت دریافت شد ',
            "data" => new LectureCourseInfoResourse($lectureCourse)
        ], 200);
    }
    public function update(LectureCourseUpdateRequest $lectureCourseUpdateRequest ,  LectureCourse $lectureCourse)
    {
        $lectureCourse->update($lectureCourseUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات اختصاص درس موفقیت ویرایش شد',
            "data" => new LectureCourseInfoResourse($lectureCourse)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = LectureCourse::find($request->item);
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
