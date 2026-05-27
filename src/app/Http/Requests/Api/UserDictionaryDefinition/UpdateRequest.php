<?php

namespace App\Http\Requests\Api\UserDictionaryDefinition;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'definition' => 'required|string',
            'example'    => 'nullable|string',
        ];
    }
}
