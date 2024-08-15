<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'uuid' => $this->uuid,
                'name' => $this->name,
                'gender' => $this->gender,
                'grade' => $this->grade,
                'employment_type' => $this->employment_type,
                'priority'=>$this->priority,
                'faculty' => $this->faculty,
                'scientific_group' => $this->scientific_group,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s')
            ];
    }
}
