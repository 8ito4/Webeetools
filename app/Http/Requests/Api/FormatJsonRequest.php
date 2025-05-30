<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FormatJsonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'json' => 'required|string',
            'action' => 'in:format,minify,validate',
            'indent' => 'integer|min:0|max:8'
        ];
    }

    public function messages(): array
    {
        return [
            'json.required' => 'O conteúdo JSON é obrigatório.',
            'action.in' => 'A ação deve ser: format, minify ou validate.',
            'indent.integer' => 'A indentação deve ser um número inteiro.',
            'indent.min' => 'A indentação deve ser no mínimo 0.',
            'indent.max' => 'A indentação deve ser no máximo 8.',
        ];
    }
} 