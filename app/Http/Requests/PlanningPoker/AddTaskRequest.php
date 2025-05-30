<?php

namespace App\Http\Requests\PlanningPoker;

use Illuminate\Foundation\Http\FormRequest;

class AddTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'task.required' => 'A tarefa é obrigatória.',
            'task.max' => 'A tarefa deve ter no máximo 255 caracteres.',
        ];
    }
} 