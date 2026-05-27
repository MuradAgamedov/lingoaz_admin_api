<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DictionaryWordResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'word'        => $this->word,
            'translation' => $this->translation,
            'image_url'   => $this->image ? url('storage/' . $this->image) : null,
            'audio_urls'  => collect($this->audio_urls ?? [])
                ->map(fn($p) => url('storage/' . $p))
                ->values(),
        ];
    }
}
