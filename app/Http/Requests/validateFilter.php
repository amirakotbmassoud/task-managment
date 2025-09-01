<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateFilter extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'status' => 'nullable|in:pending,completed,canceled',
            'due_date_from' => 'nullable|date',
            'due_date_to' => 'nullable|date|after_or_equal:due_date_from',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }
}
