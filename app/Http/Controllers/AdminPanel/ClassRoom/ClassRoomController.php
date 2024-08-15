<?php

namespace App\Http\Controllers\AdminPanel\ClassRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomStoreRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Http\Requests\FacultyStoreRequest;
use App\Http\Requests\FacultyUpdateRequest;
use App\Http\Resources\ClassRoomInfoResource;
use App\Http\Resources\FacultyInfoResource;
use App\Http\Resources\ReportResource;
use App\Models\ClassRoom;
use App\Models\Faculty;
use App\Models\ReportSystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ClassRoomController extends Controller
{
    public function index(Request $request)
    {
        $classroom = ClassRoom::query();
        if ($request->has('orderby')) {
            $classroom = $classroom->orderBy('id', $request->orderby);
        }
        if ($request->has('name')) {
            $classroom = $request->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('capacity')) {
            $classroom = $request->where('capacity', $request->capacity);
        }
        if ($request->has('projector')) {
            $classroom = $request->where('projector', $request->projector);
        }
        if ($request->has('drawing_table')) {
            $classroom = $request->where('drawing_table', $request->drawing_table);
        }
        if ($request->has('faculty_id')) {
            $classroom = $request->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('status')) {
            $classroom = $request->where('status', $request->status);
        }
        if ($request->has('perpage')) {
            $classroom = $classroom->paginate($request->perpage);
            $report = 'no';

        } else {
            $classroom = $classroom->get();
            $report = $this->reportLog('لیست کلاس های درسی دانشکده');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست کلاس های درسی دانشکده با موفقیت دریافت شد',
            "report" => $report,
            "data" => ClassRoomInfoResource::collection($classroom)->response()->getData()
        ], 200);
    }
    public function store(ClassRoomStoreRequest $classRoomStoreRequest)
    {
        $classroom = ClassRoom::create($classRoomStoreRequest->all());
        return response()->json([
            "message" => 'کلاس درسی با موفقیت ایجاد شد',
            "data" => new ClassRoomInfoResource($classroom)
        ], 200);
    }
    public function show(ClassRoom $classRoom)
    {
        return response()->json([
            "message" => 'اطلاعات کلاس درس با موفقیت دریافت شد ',
            "data" => new ClassRoomInfoResource($classRoom)
        ], 200);
    }
    public function update(ClassRoomUpdateRequest $classRoomUpdateRequest ,  ClassRoom $classRoom)
    {
        $classRoom->update($classRoomUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات کلاس درس با موفقیت ویرایش شد',
            "data" => new ClassRoomInfoResource($classRoom)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = ClassRoom::find($request->item);
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
