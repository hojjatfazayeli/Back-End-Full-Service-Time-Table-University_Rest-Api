<?php

namespace App\Http\Controllers\AdminPanel\Lecture-TimeTable;

use App\Http\Requests\LectureTimeTableStoreRequest;
use App\Http\Requests\LectureTimeTableUpdateRequest;
use App\Http\Resources\LectureTimeTableResource;
use App\Http\Resources\ReportResource;
use App\Models\Lecture;
use App\Models\LectureCourse;
use App\Models\LectureTimeTable;
use App\Models\ReportSystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class LectureTimeTableController extends Controller
{
    public function index(Request $request)
    {
        $lecture_time_table = LectureTimeTable::query();
        if ($request->has('orderby')) {
            $lecture_time_table = $lecture_time_table->orderBy('id', $request->orderby);
        }
        if ($request->has('university_id')) {
            $lecture_time_table = $lecture_time_table->where('university_id', $request->university_id);
        }
        if ($request->has('faculty_id')) {
            $lecture_time_table = $lecture_time_table->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('scientific_group_id')) {
            $lecture_time_table = $lecture_time_table->where('scientific_group_id', $request->scientific_group_id);
        }
        if ($request->has('semester_id')) {
            $lecture_time_table = $lecture_time_table->where('semester_id', $request->semester_id);
        }
        if ($request->has('lecture_id')) {
            $lecture_time_table = $lecture_time_table->where('lecture_id', $request->lecture_id);
        }
        if ($request->has('start_time')) {
            $lecture_time_table = $lecture_time_table->where('start_time', $request->start_time);
        }
        if ($request->has('end_time')) {
            $lecture_time_table = $lecture_time_table->where('end_time', $request->end_time);
        }
        if ($request->has('perpage')) {
            $lecture_time_table = $lecture_time_table->paginate($request->perpage);
            $report = 'no';

        } else {
            $lecture_time_table = $lecture_time_table->get();
            $report = $this->reportLog('لیست زمان های پیشنهادی اساتید');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست زمان های پیشنهادی اساتید با موفقیت دریافت شد',
            "report" => $report,
            "data" => LectureTimeTableResource::collection($lecture_time_table)->response()->getData()
        ], 200);
    }
    public function store(LectureTimeTableStoreRequest $lectureTimeTableStoreRequest)
    {
        foreach ($lectureTimeTableStoreRequest['time_table'] as $item)
        {
            LectureTimeTable::create(
                [
                    'university_id' => $lectureTimeTableStoreRequest['info']['university_id'],
                    'faculty_id' => $lectureTimeTableStoreRequest['info']['faculty_id'],
                    'scientific_group_id' => $lectureTimeTableStoreRequest['info']['scientific_group_id'],
                    'semester_id' => $lectureTimeTableStoreRequest['info']['semester_id'],
                    'lecture_id' => $lectureTimeTableStoreRequest['info']['lecture_id'],
                    'day' => $item['day'],
                    'start_time' => $item['start_time'],
                    'end_time' => $item['end_time'],
                ]
            );

        }
        $lecture = Lecture::find($lectureTimeTableStoreRequest['info']['lecture_id']);
        $lecture_time_table  = $lecture->lecture_time_table()->where('semester_id' , $lectureTimeTableStoreRequest['info']['semester_id'])->get();
        return response()->json([
            "message" => 'زمان پیشنهادی استاد با موفقیت ایجاد شد',
            "data" => LectureTimeTableResource::collection($lecture_time_table)
        ], 200);
    }

    public function show(LectureTimeTable $lectureTimeTable)
    {
        return response()->json([
            "message" => 'زمان پیشنهادی استاد با موفقیت دریافت شد ',
            "data" => new LectureTimeTableResource($lectureTimeTable)
        ], 200);
    }

    public function update(LectureTimeTableUpdateRequest $lectureTimeTableUpdateRequest,  LectureTimeTable $lectureTimeTable)
    {
        $lectureTimeTable->update($lectureTimeTableUpdateRequest->all());
        return response()->json([
            "message" => 'زمان پیشنهادی استاد موفقیت ویرایش شد',
            "data" => new LectureTimeTableResource($lectureTimeTable)
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
