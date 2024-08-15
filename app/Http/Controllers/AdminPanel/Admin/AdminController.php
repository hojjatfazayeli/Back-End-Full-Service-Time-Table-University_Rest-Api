<?php

namespace App\Http\Controllers\AdminPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\CheckOtpCodeRequest;
use App\Http\Requests\GetOtpCodeRequest;
use App\Http\Resources\AdminInfoResource;
use App\Http\Resources\EmployerInfoResource;
use App\Http\Resources\StewardInfoResource;
use App\Models\Admin;
use App\Models\Employer;
use App\Models\OtpCode;
use App\Models\Steward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function getOtpCode(GetOtpCodeRequest $getOtpCodeRequest)
    {
        try {
            $checkexistMobile = OtpCode::where('mobile',$getOtpCodeRequest->mobile)->first();
            if ($checkexistMobile)
            {
                Carbon::now()->addMinutes(5);
                $data = $checkexistMobile;
            }
            else
            {
                $getOtpCodeRequest['code'] = mt_rand('1111','9999');
                $code = $getOtpCodeRequest['code'];
                $data = OtpCode::create($getOtpCodeRequest->all());
            }
//                        Sms::pattern('xq7joh9o4mc22vz')->data([
//                            'verification-code' => $code
//                        ])->to([$getOtpCodeRequest->mobile])->send();

            return response()->json([
                'message' => "کد تایید با موفقیت ارسال گردید",
                'data'=>$data
            ], 200);
        }
        catch (\Throwable $e)
        {
            report($e);
            return false;
        }
    }
    public function checkOtpCode(CheckOtpCodeRequest $checkOtpCodeRequest)
    {
        try {
            $checkexistCode = OtpCode::where('mobile',$checkOtpCodeRequest->mobile)->where('code',$checkOtpCodeRequest->code)->first();
            if ($checkexistCode)
            {
                $checkexistUser = $this->checkexistUser($checkOtpCodeRequest->mobile);
                if ($checkexistUser == null)
                {
                    $checkexistCode->delete();
                    return response()->json([
                        "message"=>'کد تایید احراز شد . کاربر موردنظر در سامانه ثبت نام ننموده است',
                    ],200);
                }
                else
                {
                    $checkexistCode->delete();
                    $token = $checkexistUser->createToken("Login");
                    return response()->json([
                        "message"=>'کد مورد نظر مورد تایید است و فرد مجاز به ورود به پنل می باشد',
                        "data"=>new AdminInfoResource($checkexistUser),
                        "token"=>$token->plainTextToken,
                    ],200);
                }
            }
            else
            {
                return response()->json([
                    "message"=>'کد تایید اشتباه است',
                ],318);
            }
        }
        catch (\Throwable $e)
        {
            report($e);
            return $e;
        }

    }
    public function checkexistUser($mobile)
    {
        return Admin::where('mobile',$mobile)->first();

    }

    public function store(AdminStoreRequest $adminStoreRequest)
    {
        $admin = Admin::create($adminStoreRequest->all());
        if ($adminStoreRequest->hasFile('avatar'))
        {
            $avatarPath = Storage::putFile('/avatar' , $adminStoreRequest->avatar);
            $admin->update(['avatar' => $avatarPath]);
        }
        return response()->json([
            "message" => 'کاربر مدیر با موفقیت ایجادشد',
            "data"=> new AdminInfoResource($admin)
        ], 200);
    }
    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json([
            "message" => 'خروج با موفقیت انجام شد',
        ], 200);
    }

}
