<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AdminInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->avatar !=null ? $avatar = env('APP_URL').'/'.$this->avatar : $avatar=Null;
        $state =  DB::table('province_cities')->find($this->state_id);
        $city =  DB::table('province_cities')->find($this->city_id);

        return
            [
                'id'=>$this->id,
                'uuid'=>$this->uuid,
                'firstname'=>$this->firstname,
                'lastname'=>$this->lastname,
                'nationalcode'=>$this->nationalcode,
                'birth_certificate_id'=> $this->birth_certificate_id,
                'status_marital'=> $this->status_marital,
                'personal_id'=>$this->personal_id,
                'fathername'=>$this->fathername,
                'place_birth'=>$this->place_birth,
                'place_issuance_birth_certificate'=>$this->place_issuance_birth_certificate,
                'birth_date'=>$this->birth_date,
                'state_id'=>$state,
                'city_id'=>$city,
                'office_address'=>$this->office_address,
                'home_address'=>$this->home_address,
                'postalcode'=>$this->postalcode,
                'phone'=>$this->phone,
                'mobile'=>$this->mobile,
                'avatar'=>$avatar,
                'status'=>$this->status,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s'),
            ];
    }
}
