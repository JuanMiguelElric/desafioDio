<?php

namespace App\Http\Requests\DataMapping\Empresa;

use App\Rules\CnpjValido;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'edit_nome'          => 'required|string|max:255',
            'edit_cnpj'          => [
                'required',
                'string',
                new CnpjValido
            ],
            'edit_telefone'      => 'required|string',
            'edit_email'         => 'required|email',
            'edit_filial'        => 'array',
            'edit_filial.*.id'   => 'required|numeric',
            'edit_filial.*.nome' => 'required|string',
            'edit_filial.*.cnpj' => [
                'required',
                'string',
                new CnpjValido
            ],
            'edit_observacao'    => 'required|string|max:255',
            'edit_status'        => 'required|in:0,1'
        ];
    }

    protected function prepareForValidation()
    {
        // dd($this->all());
        $this->merge([
            'edit_cnpj'          => preg_replace('/[^0-9]/', '', $this->edit_cnpj),
            'edit_telefone'      => preg_replace('/[^0-9]/', '', $this->edit_telefone),
            'edit_filial.*.cnpj' => preg_replace('/[^0-9]/', '', $this->edit_filial_cnpj),
        ]); 
    }
}
