<?php

namespace App\Http\Controllers\AdminPanel\Faculty;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyStoreRequest;
use App\Http\Requests\FacultyUpdateRequest;
use App\Http\Requests\UniversityStoreRequest;
use App\Http\Requests\UniversityUpdateRequest;
use App\Http\Resources\FacultyInfoResource;
use App\Http\Resources\ReportResource;
use App\Http\Resources\UniversityInfoResource;
use App\Models\Faculty;
use App\Models\ReportSystem;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        $faculty = Faculty::query();
        if ($request->has('orderby')) {
            $faculty = $faculty->orderBy('id', $request->orderby);
        }
        if ($request->has('name')) {
            $faculty = $request->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('status')) {
            $faculty = $request->where('status', $request->status);
        }
        if ($request->has('university_id')) {
            $faculty = $request->where('university_id', $request->university_id);
        }
        if ($request->has('perpage')) {
            $faculty = $faculty->paginate($request->perpage);
            $report = 'no';

        } else {
            $faculty = $faculty->get();
            $report = $this->reportLog('لیست دانشکده ها');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست دانشکده ها با موفقیت دریافت شد',
            "report" => $report,
            "data" => FacultyInfoResource::collection($faculty)->response()->getData()
        ], 200);
    }

    public function store(FacultyStoreRequest $facultyStoreRequest)
    {
        $faculty = Faculty::create($facultyStoreRequest->all());
        return response()->json([
            "message" => 'دانشکده با موفقیت ایجاد شد',
            "data" => new FacultyInfoResource($faculty)
        ], 200);
    }
    public function show(Faculty $faculty)
    {
        return response()->json([
            "message" => 'اطلاعات دانشکده با موفقیت دریافت شد ',
            "data" => new FacultyInfoResource($faculty)
        ], 200);
    }

    public function update(FacultyUpdateRequest $facultyUpdateRequest ,  Faculty $faculty)
    {
        $faculty->update($facultyUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات دانشکده با موفقیت ویرایش شد',
            "data" => new FacultyInfoResource($faculty)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = Faculty::find($request->item);
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
