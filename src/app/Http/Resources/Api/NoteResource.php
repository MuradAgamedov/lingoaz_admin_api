<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'note_group_id' => $this->note_group_id,
            'title'         => $this->title,
            'content'       => $this->content,
            'updated_at'    => $this->updated_at?->toISOString(),
            'created_at'    => $this->created_at?->toISOString(),
        ];
    }
}
