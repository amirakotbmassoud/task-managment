<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => $this->title ? trim($this->title) : null,
            'description' => $this->description ? trim($this->description) : null,
        ]);
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|in:pending,completed,canceled',
                'assigned_to' => 'required|exists:users,id',
                'created_by' => 'required|exists:users,id',
                'due_date' => 'nullable|date|after_or_equal:today',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'status' => 'required|in:pending,completed,canceled',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'status.in' => 'The status must be one of the following: pending, completed, or canceled.',
            'assigned_to.exists' => 'The assigned user must exist in the users table.',
            'created_by.exists' => 'The creator must exist in the users table.',
            'due_date.after_or_equal' => 'The due date must be today or later.',
        ];
    }
}
