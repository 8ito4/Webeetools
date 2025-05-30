<?php

namespace App\Http\Requests\PlanningPoker;

use Illuminate\Foundation\Http\FormRequest;

class SetTimerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'minutes' => 'required|integer|min:1|max:60',
        ];
    }

    public function messages(): array
    {
        return [
            'minutes.required' => 'Os minutos são obrigatórios.',
            'minutes.integer' => 'Os minutos devem ser um número inteiro.',
            'minutes.min' => 'Os minutos devem ser no mínimo 1.',
            'minutes.max' => 'Os minutos devem ser no máximo 60.',
        ];
    }
} 