<?php

namespace App\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class GenerateResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullName' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'template' => 'sometimes|string|in:modern,classic,creative',
            'linkedin' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'experience' => 'nullable|array',
            'experience.*.position' => 'nullable|string|max:255',
            'experience.*.company' => 'nullable|string|max:255',
            'experience.*.startDate' => 'nullable|string|max:50',
            'experience.*.endDate' => 'nullable|string|max:50',
            'experience.*.current' => 'nullable|boolean',
            'experience.*.description' => 'nullable|string',
            'education' => 'nullable|array',
            'education.*.degree' => 'nullable|string|max:255',
            'education.*.institution' => 'nullable|string|max:255',
            'education.*.startYear' => 'nullable|string|max:10',
            'education.*.endYear' => 'nullable|string|max:10',
            'skills.technical' => 'nullable|string',
            'skills.interpersonal' => 'nullable|string',
            'skills.specialization' => 'nullable|string',
            'skills.certifications' => 'nullable|string',
            'languages' => 'nullable|array',
            'languages.*.language' => 'nullable|string|max:100',
            'languages.*.level' => 'nullable|string|max:50',
            'additional.courses' => 'nullable|string',
            'additional.projects' => 'nullable|string',
            'additional.volunteer' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'fullName.required' => 'O nome completo é obrigatório.',
            'position.required' => 'O cargo é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ter um formato válido.',
            'phone.required' => 'O telefone é obrigatório.',
            'template.in' => 'O template selecionado é inválido.',
        ];
    }
} 