<?php

namespace App\Http\Controllers\AdminPanel\Lecture;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Http\Resources\LectureInfoResource;
use App\Http\Resources\ReportResource;
use App\Models\Lecture;
use App\Models\ReportSystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        $lecture = Lecture::query();
        if ($request->has('orderby')) {
            $lecture = $lecture->orderBy('id', $request->orderby);
        }
        if ($request->has('name')) {
            $lecture = $request->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('faculty_id')) {
            $lecture = $request->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('scientific_group_id')) {
            $lecture = $request->where('scientific_group_id', $request->scientific_group_id);
        }
        if ($request->has('perpage')) {
            $lecture = $lecture->paginate($request->perpage);
            $report = 'no';

        } else {
            $lecture = $lecture->get();
            $report = $this->reportLog('لیست دروس');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست اساتید با موفقیت دریافت شد',
            "report" => $report,
            "data" => LectureInfoResource::collection($lecture)->response()->getData()
        ], 200);
    }

    public function store(LectureStoreRequest $lectureStoreRequest)
    {
        $lecture = Lecture::create($lectureStoreRequest->all());
        return response()->json([
            "message" => 'استاد با موفقیت ایجاد شد',
            "data" => new LectureInfoResource($lecture)
        ], 200);
    }
    public function show(Lecture $lecture)
    {
        return response()->json([
            "message" => 'اطلاعات استاد با موفقیت دریافت شد ',
            "data" => new LectureInfoResource($lecture)
        ], 200);
    }

    public function update(LectureUpdateRequest $lectureUpdateRequest,  Lecture $lecture)
    {
        $lecture->update($lectureUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات استاد با موفقیت ویرایش شد',
            "data" => new LectureInfoResource($lecture)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = Lecture::find($request->item);
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
