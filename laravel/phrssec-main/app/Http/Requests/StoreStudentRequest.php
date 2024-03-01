<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'json'     => 'required|in:0, 1',
            'email'    => 'required|unique:students',
            'name'     => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[!@#$%^\&*])(?=.*[0-9]).{8,}$/',
        ];
    }
}
