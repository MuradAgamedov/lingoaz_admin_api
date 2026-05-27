<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDictionaryDefinitionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                         => $this->id,
            'user_dictionary_meaning_id' => $this->user_dictionary_meaning_id,
            'definition'                 => $this->definition,
            'example'                    => $this->example,
        ];
    }
}
