<?php

namespace App\Http\Requests\Api\UserDictionaryMeaning;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'part_of_speech' => 'nullable|string|max:100',
        ];
    }
}
