<?php

namespace App\Http\Requests\DataMapping\Terceiro;

use App\Rules\CnpjValido;
use Illuminate\Foundation\Http\FormRequest;

class StoreTerceiroRequest extends FormRequest
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
            "nome_terceiro"                  => "required",
            "site_terceiro"                  => "required",
            "cnpj_terceiro"                  => ["required","string","min:14","max:14",new CnpjValido],
            "nome_do_representante"          => "required",
            "email_do_representante"         => "required|email",
            "telefone_do_representante"      => "required|string|min:11|max:11",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj_terceiro' => preg_replace('/[^0-9]/', '', $this->cnpj_terceiro),
            'telefone_do_representante' => preg_replace('/[^0-9]/', '', $this->telefone_do_representante),
        ]); 
    }
}
