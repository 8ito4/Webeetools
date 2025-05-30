<?php

namespace App\Http\Requests\PlanningPoker;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'task' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome deve ter no máximo 50 caracteres.',
            'task.required' => 'A tarefa é obrigatória.',
            'task.max' => 'A tarefa deve ter no máximo 255 caracteres.',
        ];
    }
} 