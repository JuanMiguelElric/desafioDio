<?php

namespace App\Services;

use App\Models\Pergunta;
use Exception;

class PerguntaService
{
    public function __construct(private Pergunta $pergunta)
    {
    }

    public function findById(string $id): Pergunta|bool
    {
        $pergunta = $this->pergunta->find($id);
        if($pergunta){
            return $pergunta;
        }
        throw new Exception('pergunta não localizada!');
    }

}