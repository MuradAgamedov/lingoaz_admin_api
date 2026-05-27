<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDictionaryMeaningResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'user_dictionary_id'  => $this->user_dictionary_id,
            'part_of_speech'      => $this->part_of_speech,
            'definitions'         => UserDictionaryDefinitionResource::collection(
                $this->whenLoaded('definitions', $this->definitions ?? collect())
            ),
        ];
    }
}
