<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvaliacaoRequest extends FormRequest
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
            'titulo'    => 'required|min:1|max:255',
            'descricao' => 'string|max:255',
            'cliente'   => 'string|max:255',
            'json'      => 'required|in:true,false'
        ];
    }
}
