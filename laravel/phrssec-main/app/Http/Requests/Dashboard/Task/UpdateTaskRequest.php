<?php

namespace App\Http\Requests\Dashboard\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'edit_title' => 'required',
            'edit_time'  => 'required|numeric',
            'edit_type'  => 'required|in:segundo(s),minuto(s),hora(s),dia(s)'
        ];
    }
}
