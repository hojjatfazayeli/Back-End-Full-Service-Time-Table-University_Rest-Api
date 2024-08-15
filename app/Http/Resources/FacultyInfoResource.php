<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultyInfoResource extends JsonResource
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
                'id'=> $this->id,
                'uuid' => $this->uuid,
                'name' => $this->name,
                'status' => $this->status,
                "created_at"=>$this->created_at->format('Y-m-d - H:i:s'),
                "updated_at"=>$this->updated_at->format('Y-m-d - H:i:s'),
                'university' => new UniversityInfoResource($this->university),
                'creator' => $this->admin
            ];
    }
}
