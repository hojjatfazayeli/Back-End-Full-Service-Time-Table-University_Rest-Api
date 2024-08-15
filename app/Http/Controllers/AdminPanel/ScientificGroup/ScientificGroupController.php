<?php

namespace App\Http\Controllers\AdminPanel\ScientificGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomStoreRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Http\Requests\ScientificGroupStoreRequest;
use App\Http\Requests\ScientificGroupUpdateRequest;
use App\Http\Resources\ClassRoomInfoResource;
use App\Http\Resources\ReportResource;
use App\Http\Resources\ScientificGroupInfoResource;
use App\Models\ClassRoom;
use App\Models\ReportSystem;
use App\Models\ScientificGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ScientificGroupController extends Controller
{
    public function index(Request $request)
    {
        $scientific_group = ScientificGroup::query();
        if ($request->has('orderby')) {
            $scientific_group = $scientific_group->orderBy('id', $request->orderby);
        }
        if ($request->has('title')) {
            $scientific_group = $request->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->has('faculty_id')) {
            $scientific_group = $request->where('faculty_id', $request->faculty_id);
        }
        if ($request->has('perpage')) {
            $scientific_group = $scientific_group->paginate($request->perpage);
            $report = 'no';

        } else {
            $scientific_group = $scientific_group->get();
            $report = $this->reportLog('لیست گروه های آموزشی دانشکده');
            $report = new ReportResource($report);

        }
        return response()->json([
            "message" => 'لیست گروه های آموزشی دانشکده با موفقیت دریافت شد',
            "report" => $report,
            "data" =>   ScientificGroupInfoResource::collection($scientific_group)->response()->getData()
        ], 200);
    }

    public function store(ScientificGroupStoreRequest $scientificGroupStoreRequest)
    {
        $scientific_group = ScientificGroup::create($scientificGroupStoreRequest->all());
        return response()->json([
            "message" => 'گروه علمی با موفقیت ایجاد شد',
            "data" => new ScientificGroupInfoResource($scientific_group)
        ], 200);
    }
    public function show(ScientificGroup $scientificGroup)
    {
        return response()->json([
            "message" => 'اطلاعات گروه های درسی دانشکده با موفقیت دریافت شد ',
            "data" => new ScientificGroupInfoResource($scientificGroup)
        ], 200);
    }
    public function update(ScientificGroupUpdateRequest $scientificGroupUpdateRequest ,  ScientificGroup $scientificGroup)
    {
        $scientificGroup->update($scientificGroupUpdateRequest->all());
        return response()->json([
            "message" => 'اطلاعات گروه درسی با موفقیت ویرایش شد',
            "data" => new ScientificGroupInfoResource($scientificGroup)
        ], 200);
    }
    public function autoDestroy(Request $request)
    {
        $item = ScientificGroup::find($request->item);
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
