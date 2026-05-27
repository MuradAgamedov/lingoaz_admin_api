<?php

namespace App\Http\Requests\SentenceDictionary;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sentence_dictionary_group_category_id' => 'required|integer|exists:sentence_dictionary_group_categories,id',
            'word'        => 'required|string|max:500',
            'translation' => 'required|string|max:500',
        ];
    }
}
