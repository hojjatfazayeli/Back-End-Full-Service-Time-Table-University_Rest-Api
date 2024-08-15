<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UniversityInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->logo !=null ? $logo = env('APP_URL').'/'.$this->logo : $logo=Null;
        $state =  DB::table('province_cities')->find($this->state_id);
        $city =  DB::table('province_cities')->find($this->city_id);
        return
            [
                'id'=>$this->id,
                'uuid'=>$this->uuid,
                'code' => $this->code,
                'type' => $this->type,
                'name' => $this->name,
                'description' => $this->description,
                'phone' => $this->phone,
                'fax' => $this->fax,
                'state' => $state,
                'city' => $city,
                'address' => $this->address,
                'website' => $this->website,
                'logo' => $logo,
                'status' => $this->status,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s'),
                'creator' => $this->admin
            ];
    }
}
