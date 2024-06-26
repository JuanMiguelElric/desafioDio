<?php

namespace App\Http\Requests\Dashboard\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required',
            'time'  => 'required|numeric',
            'type'  => 'required|in:segundo(s),minuto(s),hora(s),dia(s)'
        ];
    }
}
