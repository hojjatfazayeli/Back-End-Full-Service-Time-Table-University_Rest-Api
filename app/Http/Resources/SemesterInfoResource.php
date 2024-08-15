<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SemesterInfoResource extends JsonResource
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
                'year' => $this->year,
                'semester_number' => $this->semester_number,
                'number_week' => $this->number_week,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s'),
                'university' => $this->university,
                'faculty' => $this->faculty,
                'creator' => $this->admin
            ];
    }
}
