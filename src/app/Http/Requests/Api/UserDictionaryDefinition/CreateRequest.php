<?php

namespace App\Http\Requests\Api\UserDictionaryDefinition;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'user_dictionary_meaning_id' => 'required|exists:user_dictionary_meanings,id',
            'definition'                 => 'required|string',
            'example'                    => 'nullable|string',
        ];
    }
}
