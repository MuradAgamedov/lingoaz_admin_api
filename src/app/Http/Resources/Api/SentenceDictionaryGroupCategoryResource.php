<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SentenceDictionaryGroupCategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                            => $this->id,
            'sentence_dictionary_group_id'  => $this->sentence_dictionary_group_id,
            'title'                         => $this->title,
        ];
    }
}
