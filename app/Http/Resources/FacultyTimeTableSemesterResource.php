<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultyTimeTableSemesterResource extends JsonResource
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
                'week' => $this->week,
                'day' => $this->day,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s'),
            ];
    }
}
