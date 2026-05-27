<?php

namespace App\Http\Requests\Api\UserDictionaryMeaning;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'user_dictionary_id' => 'required|exists:user_dictionaries,id',
            'part_of_speech'     => 'nullable|string|max:100',
        ];
    }
}
