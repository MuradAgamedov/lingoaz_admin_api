<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SentenceDictionaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                                    => $this->id,
            'sentence_dictionary_group_category_id' => $this->sentence_dictionary_group_category_id,
            'word'                                  => $this->word,
            'translation'                           => $this->translation,
            'audio_urls'                            => collect($this->audio_urls ?? [])
                                                        ->map(fn($p) => url('storage/' . $p))
                                                        ->values(),
        ];
    }
}
