<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
                'id'=>$this->id,
                'uuid'=>$this->uuid,
                'type'=>$this->type,
                'creator'=> $this->firstname.' '.$this->lastname,
                'number'=>$this->row,
                'row'=>$this->id,
                'date'=>$this->created_at,
                'time'=>$this->time,

            ];
    }
}
