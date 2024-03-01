<?php

namespace App\Services;

use App\Models\Alternativa;
use App\Models\Pergunta;
use Exception;

class AlternativaService
{
    public function __construct(private Alternativa $alternativa, private PerguntaService $perguntaService)
    {
    }

    public function add(array $data): Alternativa|bool
    {
        $pergunta = $this->perguntaService->findById($data['pergunta']);
        if ($pergunta) {
            $alternativa = new Alternativa(
                [
                    'opcao'      => $data['opcao'],
                    'verdadeiro' => $data['verdadeiro']
                ]
            );
            $result = $pergunta->alternativas()->save($alternativa);
            if ($result) {
                return $result;
            }
            return false;
        }
        return false;
    }

    public function verificaAlternativa(array $data): bool
    {
        $resultado = $this->perguntaService->findById($data['pergunta_id']);
        dd($resultado);
        throw new Exception('Alternativa não pertence a pergunta');
    }
    public function findById(int $id): Alternativa|bool
    {
        return $this->alternativa->findOrFail($id);
    }
}
