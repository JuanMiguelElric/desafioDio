<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $cpf = preg_replace('/\D/','',(string)$value);
        if(strlen($cpf) !== 11){
            $fail($this->message());
        }
        // Faz o cálculo para validar o CPF
        for($t = 9; $t < 11; $t++){
            for($d = 0, $c = 0; $c < $t; $c++){
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if($cpf[$c] != $d){
                $fail($this->message());
            }
        }
    }

    public function message(): string
    {
        return 'Atributo inválido';
    }
}
