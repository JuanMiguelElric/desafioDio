<?php

namespace App\Http\Requests\DataMapping\Pessoa;

use App\Rules\CpfValido;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePessoa extends FormRequest
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
            "nome_completo" => "required",
            "nome_social" => "required",
            "cpf"=>["required", "string", "min:11", "max:11", new CpfValido],
            "telefone"=> ["required", "string", "min:11", "max:11"],
            "whatsapp"=>"boolean",
            "email" => ["required","email"],
            //
        ];
    }
    protected function prepareForValidation(){
        $this->merge([
            'cpf'=> preg_replace('/[^0-9]/','',$this->cpf),
            'telefone'=>preg_replace('/[^0-9]/', '', $this->telefone),
            'whatsapp' => filter_var($this->whatsapp, FILTER_VALIDATE_BOOLEAN) // Converte para boolean
        ]);
    }
}
