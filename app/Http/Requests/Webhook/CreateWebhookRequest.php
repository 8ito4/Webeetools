<?php

namespace App\Http\Requests\Webhook;

use Illuminate\Foundation\Http\FormRequest;

class CreateWebhookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_name' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'project_name.max' => 'O nome do projeto deve ter no máximo 255 caracteres.',
        ];
    }
} 