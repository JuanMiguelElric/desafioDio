<?php

namespace App\Http\Requests\DataMapping\Departamento;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartamentoRequest extends FormRequest
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
            "nome"        => "required|max:255",
            "responsavel" => "required|max:255",
            "telefone"    => "required",
            "email"       => "required|email",
            "status"      => "required|in:0,1"
        ];
    }
}
