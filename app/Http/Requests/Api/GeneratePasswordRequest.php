<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'length' => 'integer|min:8|max:128',
            'uppercase' => 'boolean',
            'lowercase' => 'boolean',
            'numbers' => 'boolean',
            'symbols' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'length.integer' => 'O comprimento deve ser um número inteiro.',
            'length.min' => 'O comprimento deve ser no mínimo 8 caracteres.',
            'length.max' => 'O comprimento deve ser no máximo 128 caracteres.',
            'uppercase.boolean' => 'O campo maiúsculas deve ser verdadeiro ou falso.',
            'lowercase.boolean' => 'O campo minúsculas deve ser verdadeiro ou falso.',
            'numbers.boolean' => 'O campo números deve ser verdadeiro ou falso.',
            'symbols.boolean' => 'O campo símbolos deve ser verdadeiro ou falso.',
        ];
    }
} 