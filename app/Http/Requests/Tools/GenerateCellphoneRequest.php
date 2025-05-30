<?php

namespace App\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class GenerateCellphoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ddd' => 'nullable|string|max:2',
        ];
    }

    public function messages(): array
    {
        return [
            'ddd.max' => 'O DDD deve ter no máximo 2 caracteres.',
        ];
    }
} 