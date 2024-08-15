<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScientificGroupInfoResource extends JsonResource
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
                'title' => $this->title,
                'faculty' => new FacultyInfoResource($this->faculty),
                'creator' => $this->admin
            ];
    }
}
