<?php

namespace App\Services;

use App\Models\AvaliacoesEstudantes;
use Exception;

class AvaliacoesEstudantesService
{
    public function __construct(
        private StudentService $studentService,
        private AvaliacaoService $avaliacaoService,
        private AvaliacoesEstudantes $avaliacoesEstudantes
    ) {
    }

    public function findById(string $id): AvaliacoesEstudantes|bool
    {
        $avaliacoesEstudantes = $this->avaliacoesEstudantes->find($id);
        if ($avaliacoesEstudantes) {
            return $avaliacoesEstudantes;
        }
        return false;
    }

    public function where(array $data): AvaliacoesEstudantes|bool
    {
        $avaliacoesEstudantes = $this->avaliacoesEstudantes->where($data)->get();
        if ($avaliacoesEstudantes) {
            return $avaliacoesEstudantes;
        }
        return false;
    }

    public function add(array $data):AvaliacoesEstudantes|bool
    {
        //verifica se existe o estudante e a avaliação
        $estudante = $this->studentService->findById($data['estudante']);
        $avaliacao = $this->avaliacaoService->findById($data['avaliacao']);
        if (!$estudante && !$avaliacao) {
            return false;
        }
        //verifica se o estudante já está atríbuido na avaliação
        $avaliacoesEstudantes = $this->avaliacoesEstudantes->where(['avaliacao_id' => $data['avaliacao'], 'student_id' => $data['estudante']])->get();
        if (!$avaliacoesEstudantes->isEmpty()) {
            throw new Exception("o aluno já está cadastrado nesse curso!", 400);
            return false;
        }
        
        //verifica se existe o estudaante e a avaliação
        if ($avaliacao && $estudante) {
            $avaliacaoEstudante = AvaliacoesEstudantes::create([
                'student_id'   => $estudante->id,
                'avaliacao_id' => $avaliacao->id
            ]);
            return $avaliacaoEstudante;
        }
        throw new Exception('não foi possível atribuir a avaliação ao aluno(a)', 400);
        return false;
    }

    public function update(array $data): void
    {
        
    }
}
