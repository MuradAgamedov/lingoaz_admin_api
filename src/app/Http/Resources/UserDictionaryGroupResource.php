<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDictionaryGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'image_url' => $this->image
                ? url('storage/' . $this->image)
                : null,
            'order'     => $this->order,
            'user'      => $this->whenLoaded('user', function () {
                return [
                    'id'       => $this->user->id,
                    'username' => $this->user->username,
                    'email'    => $this->user->email,
                ];
            }),
        ];
    }
}
