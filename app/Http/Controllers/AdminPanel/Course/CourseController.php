<?php

namespace App\Http\Controllers\AdminPanel\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseInfoResource;
use App\Http\Resources\ReportResource;
use App\Models\Course;
use App\Models\ReportSystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $course = Course::query();
        if ($request->has('orderby')) {
            $course = $course->orderBy('id', $request->orderby);
        }
        if ($request->has('name')) {
            $course = $request->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('code')) {
            $course = $request->where('code', $request->code);
        }
        if ($request->has('unit')) {
            $course = $request->where('unit', $request->unit);
        }
        if ($request->has('faculty_id')) {
            $course = $request->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('scientific_group_id')) {
            $course = $request->where('scientific_group_id', $request->scientific_group_id);
        }
        if ($request->has('perpage')) {
            $course = $course->paginate($request->perpage);
            $report = 'no';

        } else {
            $course = $course->get();
            $report = $this->reportLog('لیست دروس');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست دروس با موفقیت دریافت شد',
            "report" => $report,
            "data" => CourseInfoResource::collection($course)->response()->getData()
        ], 200);
    }
    public function store(CourseStoreRequest $courseStoreRequest)
    {
        $course = Course::create($courseStoreRequest->all());
        return response()->json([
            "message" => 'دانشکده با موفقیت ایجاد شد',
            "data" => new CourseInfoResource($course)
        ], 200);
    }
    public function show(Course $course)
    {
        return response()->json([
            "message" => 'اطلاعات درس با موفقیت دریافت شد ',
            "data" => new CourseInfoResource($course)
        ], 200);
    }
    public function update(CourseUpdateRequest $courseUpdateRequest,  Course $course)
    {
        $course->update($courseUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات درس با موفقیت ویرایش شد',
            "data" => new CourseInfoResource($course)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = Course::find($request->item);
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
