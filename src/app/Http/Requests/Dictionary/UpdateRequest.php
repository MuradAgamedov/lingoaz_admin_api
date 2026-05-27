<?php

namespace App\Http\Requests\Dictionary;

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
            'audios' => 'nullable|array',
            'audios.*' => 'file|mimes:mp3,wav',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:dictionary_categories,id',
        ];
    }
}
