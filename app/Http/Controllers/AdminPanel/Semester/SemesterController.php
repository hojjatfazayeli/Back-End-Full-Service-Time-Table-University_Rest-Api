<?php

namespace App\Http\Controllers\AdminPanel\Semester;

use App\Http\Controllers\Controller;
use App\Http\Requests\SemesterStoreRequest;
use App\Http\Requests\SemesterUpdateRequest;
use App\Http\Resources\ReportResource;
use App\Http\Resources\SemesterInfoResource;
use App\Models\ReportSystem;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        $semester = Semester::query();
        if ($request->has('orderby')) {
            $semester = $semester->orderBy('id', $request->orderby);
        }
        if ($request->has('year')) {
            $semester = $request->where('year', $request->year);
        }
        if ($request->has('semester_number')) {
            $semester = $request->where('semester_number', $request->semester_number);
        }
        if ($request->has('number_week')) {
            $semester = $request->where('number_week', $request->number_week);
        }
        if ($request->has('start_date')) {
            $semester = $request->where('start_date', $request->start_date);
        }
        if ($request->has('end_date')) {
            $semester = $request->where('end_date', $request->end_date);
        }
        if ($request->has('start_time')) {
            $semester = $request->where('start_time', $request->start_time);
        }
        if ($request->has('end_time')) {
            $semester = $request->where('end_time', $request->end_time);
        }
        if ($request->has('university_id')) {
            $semester = $request->where('university_id', $request->university_id);
        }
        if ($request->has('faculty_id')) {
            $semester = $request->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('perpage')) {
            $semester = $semester->paginate($request->perpage);
            $report = 'no';

        } else {
            $semester = $semester->get();
            $report = $this->reportLog('لیست ترم های تحصیلی');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست ترم های تحصیلی با موفقیت دریافت شد',
            "report" => $report,
            "data" => SemesterInfoResource::collection($semester)->response()->getData()
        ], 200);
    }

    public function store(SemesterStoreRequest $semesterStoreRequest)
    {
        $semester = Semester::create($semesterStoreRequest->all());
        return response()->json([
            "message" => 'ترم تحصیلی با موفقیت ایجاد شد',
            "data" => new SemesterInfoResource($semester)
        ], 200);
    }
    public function show(Semester $semester)
    {
        return response()->json([
            "message" => 'اطلاعات ترم تحصیلی با موفقیت دریافت شد ',
            "data" => new SemesterInfoResource($semester)
        ], 200);
    }

    public function update(SemesterUpdateRequest $semesterUpdateRequest ,  Semester $semester)
    {
        $semester->update($semesterUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات ترم تحصیلی با موفقیت ویرایش شد',
            "data" => new SemesterInfoResource($semester)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = Semester::find($request->item);
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
