<?php

namespace App\Http\Requests\NoteGroup\Note;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'   => 'required|string|max:500',
            'content' => 'required|string',
        ];
    }
}
