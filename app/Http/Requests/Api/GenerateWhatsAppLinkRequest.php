<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GenerateWhatsAppLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|min:8|max:20',
            'message' => 'nullable|string|max:1000',
            'shorten' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'O número de telefone é obrigatório.',
            'phone.min' => 'O número de telefone deve ter pelo menos 8 caracteres.',
            'phone.max' => 'O número de telefone deve ter no máximo 20 caracteres.',
            'message.max' => 'A mensagem deve ter no máximo 1000 caracteres.',
            'shorten.boolean' => 'O campo de encurtamento deve ser verdadeiro ou falso.',
        ];
    }
} 