<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseInfoResource extends JsonResource
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
                'code' => $this->code,
                'unit' => $this->unit,
                'name' => $this->name,
                'faculty' => $this->faculty,
                'scientific_group' => $this->scientific_group,
                'creator' => $this->admin,
            ];
    }
}
