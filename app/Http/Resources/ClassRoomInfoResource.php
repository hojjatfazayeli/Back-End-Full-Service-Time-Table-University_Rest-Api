<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassRoomInfoResource extends JsonResource
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
                'number' => $this->number,
                'name' => $this->name,
                'capacity' => $this->capacity,
                'projector' => $this->projector,
                'drawing_table' => $this->drawing_table,
                'status' => $this->status,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s'),
                'faculty' => new FacultyInfoResource($this->faculty),
                'creator' => $this->admin
            ];
    }
}
