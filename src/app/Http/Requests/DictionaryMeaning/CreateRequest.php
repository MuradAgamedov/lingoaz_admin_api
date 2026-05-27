<?php

namespace App\Http\Requests\DictionaryMeaning;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'part_of_speech' => 'nullable|string|max:255',
            'definitions' => 'required|array|min:1',
            'definitions.*.definition' => 'required|string',
            'definitions.*.example' => 'nullable|string',
        ];
    }
}
