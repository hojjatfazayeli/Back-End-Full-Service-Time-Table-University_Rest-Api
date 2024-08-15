<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureTimeTableResource extends JsonResource
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
                'university' => $this->university,
                'faculty' => $this->faculty,
                'scientific_group' => $this->scientific_group,
                'semester' => $this->semester,
                'lecture' => $this->lecture,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ];
    }
}
