<?php

namespace App\Http\Requests\PlanningPoker;

use Illuminate\Foundation\Http\FormRequest;

class SelectCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'card.required' => 'A carta é obrigatória.',
        ];
    }
} 