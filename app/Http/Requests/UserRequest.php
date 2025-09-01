<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
protected function prepareForValidation()
{
    $this->merge([
        'name' =>  $this->name?trim($this->name):null,
        'email' => $this->email?strtolower(trim($this->email)):null,
        'role'=> $this->role?strtolower(trim($this->role)):null

    ]);
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ public function rules(): array
    {
        // لو بعمل update هستثني اليوزر الحالي من الـ unique check
        $userId = $this->route('user'); // لازم يكون عندك في الـ route حاجة زي /users/{user}

        $rules = [
            'name' => [
                $this->isMethod('post') ? 'required' : 'sometimes',
                'string',
                'max:255'
            ],
            'email' => [
                $this->isMethod('post') ? 'required' : 'sometimes',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId, 'id'),
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'min:6'
            ],
            'role' => [
                $this->isMethod('post') ? 'required' : 'sometimes',
                Rule::in(['manager', 'user']),
            ],
        ];

        return $rules;
    }
}
