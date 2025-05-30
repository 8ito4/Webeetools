<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GenerateLoremRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'in:words,sentences,paragraphs',
            'count' => 'integer|min:1|max:50',
            'start_with_lorem' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'type.in' => 'O tipo deve ser: words, sentences ou paragraphs.',
            'count.integer' => 'A quantidade deve ser um número inteiro.',
            'count.min' => 'A quantidade deve ser no mínimo 1.',
            'count.max' => 'A quantidade deve ser no máximo 50.',
            'start_with_lorem.boolean' => 'O campo iniciar com Lorem deve ser verdadeiro ou falso.',
        ];
    }
} 