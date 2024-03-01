<?php

namespace App\Http\Requests\DataMapping\Empresa;

use App\Rules\CnpjValido;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreEmpresaRequest extends FormRequest
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
            'nome'          => 'required|string|max:255',
            'cnpj'          => [
                'required',
                'string',
                new CnpjValido
            ],
            'telefone'      => 'required|string|regex:/(\d{0,2})(\d{0,5})(\d{0,4})/',
            'email'         => 'required|email',
            'observacao'    => 'required|string|max:255',
            'filial'        => 'array',
            'filial.*.nome' => 'required|string|max:255',
            'filial.*.cnpj' => 'required|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' => preg_replace('/[^0-9]/', '', $this->cnpj),
            'telefone' => preg_replace('/[^0-9]/', '', $this->telefone),
            'filial.*.cnpj' => preg_replace('/[^0-9]/', '', $this->cnpj),
        ]); 
    }
}
