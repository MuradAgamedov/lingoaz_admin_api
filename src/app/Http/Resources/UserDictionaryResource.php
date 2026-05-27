<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDictionaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                       => $this->id,
            'word'                     => $this->word,
            'translation'              => $this->translation,
            'user_dictionary_group_id' => $this->user_dictionary_group_id,
            'audio_urls'               => collect($this->audio_urls ?? [])
                                            ->map(fn($p) => url('storage/' . $p))
                                            ->values(),
            'created_at'               => $this->created_at?->toISOString(),
        ];
    }
}
