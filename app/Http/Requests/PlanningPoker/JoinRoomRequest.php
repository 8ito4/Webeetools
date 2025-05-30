<?php

namespace App\Http\Requests\PlanningPoker;

use Illuminate\Foundation\Http\FormRequest;

class JoinRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'code' => 'required|string|size:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome deve ter no máximo 50 caracteres.',
            'code.required' => 'O código da sala é obrigatório.',
            'code.size' => 'O código da sala deve ter exatamente 6 caracteres.',
        ];
    }
} 