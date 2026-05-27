<?php

namespace App\Http\Requests\Api\UserDictionary;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'word' => 'required|string|max:255',
            'translation' => 'required|string|max:255',
            'user_dictionary_group_id' => 'required|exists:user_dictionary_groups,id',
            'audio_urls' => 'nullable|array',
            'audio_urls.*' => 'nullable|mimes:mp3,wav',
        ];
    }
}
