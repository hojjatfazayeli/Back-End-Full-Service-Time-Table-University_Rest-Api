<?php

namespace App\Http\Controllers\AdminPanel\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityStoreRequest;
use App\Http\Requests\UniversityUpdateRequest;
use App\Http\Resources\AdminInfoResource;
use App\Http\Resources\EmployerInfoResource;
use App\Http\Resources\ReportResource;
use App\Http\Resources\UniversityInfoResource;
use App\Models\Employer;
use App\Models\Package;
use App\Models\ReportSystem;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class UniversityController extends Controller
{

    public function index(Request $request)
    {
        $university = University::query();
        if ($request->has('orderby')) {
            $university = $university->orderBy('id', $request->orderby);
        }
        if ($request->has('name')) {
            $university = $request->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('address')) {
            $university = $request->where('address', 'LIKE', '%' . $request->address . '%');
        }
        if ($request->has('type')) {
            $university = $request->where('type', $request->type);
        }
        if ($request->has('phone')) {
            $university = $request->where('phone', $request->phone);
        }
        if ($request->has('fax')) {
            $university = $request->where('fax', $request->fax);
        }
        if ($request->has('state_id')) {
            $university = $request->where('state_id', $request->state_id);
        }
        if ($request->has('city_id')) {
            $university = $request->where('city_id', $request->city_id);
        }
        if ($request->has('website')) {
            $university = $request->where('website', $request->website);
        }
        if ($request->has('status')) {
            $university = $request->where('status', $request->status);
        }
        if ($request->has('perpage')) {
            $university = $university->paginate($request->perpage);
            $report = 'no';

        } else {
            $university = $university->get();
            $report = $this->reportLog('لیست دانشگاه ها');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست دانشگاه ها با موفقیت دریافت شد',
            "report" => $report,
            "data" => UniversityInfoResource::collection($university)->response()->getData()
        ], 200);
    }

    public function store(UniversityStoreRequest $universityStoreRequest)
    {
        $university = University::create($universityStoreRequest->all());
        if ($universityStoreRequest->hasFile('logo')) {
            $logoPath = Storage::putFile('/logo', $universityStoreRequest->logo);
            $university->update(['logo' => $logoPath]);
            return response()->json([
                "message" => 'دانشگاه با موفقیت ایجاد شد',
                "data" => new UniversityInfoResource($university)
            ], 200);
        }
    }
    public function show(University $university)
    {
        return response()->json([
            "message" => 'اطلاعات دانشگاه با موفقیت دریافت شد ',
            "data" => new UniversityInfoResource($university)
        ], 200);
    }

    public function update(UniversityUpdateRequest $universityUpdateRequest ,  University $university)
    {
        $university->update($universityUpdateRequest->except('logo'));
        if ($universityUpdateRequest->hasFile('logo')) {
            $logoPath = Storage::putFile('/logo', $universityUpdateRequest->logo);
            $university->update(['logo' => $logoPath]);
            return response()->json([
                "message" => 'اطلاعات دانشگاه با موفقیت ویرایش شد',
                "data" => new UniversityInfoResource($university)
            ], 200);
        }
    }
    public function autoDestroy(Request $request)
    {
        $item = University::find($request->item);
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
