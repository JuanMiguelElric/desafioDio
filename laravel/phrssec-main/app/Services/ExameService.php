<?php

namespace App\Services;

use App\Models\Alternativa;
use App\Models\Avaliacao;
use App\Models\AvaliacoesEstudantes;
use App\Models\Respostas;
use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ExameService
{
    public function __construct(
        private Avaliacao $avaliacao,
        private AvaliacaoService $avaliacaoService,
        private Student $studentService,
        private AvaliacoesEstudantes $avaliacoesEstudantesService,
        private Respostas $respostasService,
        private AlternativaService $alternativaService,
        private PerguntaService $perguntaService
    ) {
    }

    public function ExameJaConcluido($student, $id)
    {
        // dd($student, $id);
        return $this->avaliacoesEstudantesService->where([
            'student_id'   => $student,
            'avaliacao_id' => $id,
            'concluido' => true
        ])->count();
    }

    public function exame(string $id)
    {
        $user = Auth::guard('avaliacao')->user();
        //verifica se a avaliação está concluída pelo estudante
        $exameConcluido = $this->ExameJaConcluido($user->id, $id);
        // dd($exameConcluido);
        if ($exameConcluido != 0) {
            throw new Exception('Exame concluído!');
        }
        if ($user == null) {
            throw new Exception('Usuário não encontrado!');
        }

        // verifica se o student está na avaliação
        $avaliacao = $this->avaliacao::with(['perguntas.alternativas', 'respostas' => function ($query) use ($user) {
            $query->where('student_id', $user->id);
        }, 'avaliacoes_estudantes' => function ($query) use ($user) {
            $query->where(['student_id' => $user->id, 'concluido' => false]);
        }])->find($id);

        if ($avaliacao == null) {
            throw new Exception('não foi possível localizar avaliação em questão!');
        }
        $perguntas = $avaliacao->perguntas()->with(['alternativas', 'respostas' => function ($query) use ($user) {
            $query->where('student_id', $user->id);
        }])->paginate(1);
        // dd($perguntas,$perguntas->currentPage(), $perguntas->lastPage());
        if ($perguntas->isEmpty()) {
            throw new Exception('pergunta não encontrada');
        }

        $resposta = $perguntas[0]->respostas->first();
        if ($resposta) {
            $perguntas[0]->alternativas->each(function ($alternativa) use ($resposta) {

                if ($alternativa->id === $resposta->alternativa_id) {
                    $alternativa->respondido = true;
                }
            });
        }

        // dd($perguntas[0]->alternativas, $resposta);
        if ($perguntas->isEmpty()) {
            throw new Exception('Avaliação em produção!');
        }

        if ($avaliacao->avaliacoes_estudantes->isEmpty()) {
            throw new Exception('Usuário não cadastrado no sistema de avaliação selecionado!');
        }

        return compact('avaliacao', 'perguntas');
    }

    public function verificaSeAlunoEstaMatriculado(array $data)
    {
        $resultado = $this->avaliacoesEstudantesService->where([
            'student_id'   => $data['student_id'],
            'avaliacao_id' => $data['student_id']
        ])->last();
        // dd($resultado);
        if ($resultado) {
            return true;
        }
        return false;
    }

    //apagar
    // public function verificaResposta(array $data)
    // {
    //     //verifica se o estudante respondeu a pergunta que foi enviado através da requisição
    //     $resultado = $this->respostasService->with(['perguntas.alternativas'])->where([
    //         'student_id'   => $data['student_id'],
    //         'avaliacao_id' => $data['avaliacao_id'],
    //         'pergunta_id'  => $data['pergunta_id']
    //     ])->get();
    //     //validar se a alternativa que veio pertence a pergunta e se a pergunta pertence a avaliação
    //     if($resultado->isEmpty()){

    //         dd($this->alternativaService->verificaAlternativa($data));
    //         return true;
    //     }

    //     // dd($resultado);
    //     //se existir a resposta, será verificado se alternativa que ele está inserindo já foi respondida
    //     if ($resultado->isNotEmpty()) {
    //         // Se a resposta existe, verifique a alternativa
    //         if ($resultado[0]->alternativa_id == $data['alternativa_id']) {
    //             return true; // A alternativa já foi respondida
    //         } else {
    //             foreach ($resultado[0]->perguntas->alternativas as $alternativa) {
    //                 if ($alternativa->id == $data['alternativa_id']) {
    //                     $resultado[0]->alternativa_id = $data['alternativa_id'];
    //                     $resultado[0]->save();
    //                     return true;
    //                 }
    //             }
    //             throw new Exception('alternativa nao pertencente á pergunta');
    //         }
    //     } else {
    //         // Se não existir resposta, crie uma nova
    //         $avaliacao = $this->avaliacaoService->with(['perguntas' => function ($query) use($data) {
    //             $query->where('id', $data['pergunta_id']);
    //         }, 'perguntas.alternativas'])->find($data['avaliacao_id']);

    //         dd($avaliacao,
    //         $avaliacao->perguntas[0]->alternativas,$data['alternativa_id']);
    //         foreach ($avaliacao->perguntas[0]->alternativas as $alternativa) {
    //             dd($data);
    //             if ($alternativa->id == $data['alternativa_id']) {
    //                 return $this->respostasService->create($data);
    //             }
    //         } 
    //         throw new Exception('alternativa não pertence á pergunta');
    //     }
    //     throw new Exception('caindo no final');
    // }

    public function verificaResposta(array $data)
    {
        //verifica se existe uma pergunta respondida
        $respostaCollection = $this->respostasService->with(['perguntas.alternativas'])->where([
            'student_id'   => $data['student_id'],
            'avaliacao_id' => $data['avaliacao']->id,
            'pergunta_id'  => $data['pergunta_id']
        ])->get();
        if ($respostaCollection->count() > 1) {
            //remover possíveis duplicidades 
            $respostaCollection = $this->removeDuplicidade($respostaCollection);
        }
        //se houver retorna retorna a resposta para ser atualizada
        if ($respostaCollection) {
            return $respostaCollection->first();
        }
        return false;
    }

    public function removeDuplicidade(Collection $respostas): Respostas
    {
        $firstIteration = true;
        /**
         * @var Respostas $firstRecord
         */
        $firstRecord = null;
        foreach ($respostas as $resposta) {
            if ($firstIteration) {
                $firstIteration = false;
                $firstRecord = $resposta;
                continue;
            }
            $resposta->delete();
        }
        return $firstRecord;
    }

    public function addResposta(array $data)
    {
        // dd($data);
        $exameConcluido = $this->ExameJaConcluido($data['student_id'], $data['avaliacao']->id);
        // dd($exameConcluido);
        if ($exameConcluido != 0) {
            throw new Exception('Exame concluído!');
        }
        $respostaObOrFalse = $this->verificaResposta($data);

        //verifica se alternativa, pergunta e avaliação existem e se elas sem comunicam
        $alternativa = $this->alternativaService->findById($data['alternativa_id']);
        $pergunta = $this->perguntaService->findById($data['pergunta_id']);
        if (!$data['avaliacao']->perguntas->contains($pergunta)) {
            throw new Exception('pergunta não pertence a avaliação!');
        }
        if (!$pergunta->alternativas->contains($alternativa)) {
            throw new Exception('Alternativa não pertence a pergunta!');
        }
        // dd($data);
        // dd(
        //     [
        //         'avaliacao' => $data['avaliacao'],
        //         'pergunta' => $pergunta,
        //         'alternativa'=>$alternativa,
        //         'Pergunta > Avaliacao' => $data['avaliacao']->perguntas->contains($pergunta),
        //         'Alternativa > Pergunta' => $pergunta->alternativas->contains($alternativa),

        //     ],
        // );

        //se houver objeto de resposta, atualize
        if ($respostaObOrFalse) {
            $respostaObOrFalse->update(['alternativa_id' => $data['alternativa_id']]);
            return $respostaObOrFalse;
        }

        // cria nova resposta
        $respostaObOrFalse = $this->respostasService->create([
            'alternativa_id' => $data['alternativa_id'],
            'student_id'     => $data['student_id'],
            'pergunta_id'    => $data['pergunta_id'],
            'avaliacao_id'   => $data['avaliacao']->id
        ]);

        return $respostaObOrFalse;
    }

    public function concluirExame(array $data)
    {
        $teste = $this->respostasService->where([
            'student_id'   => $data['student_id'],
            'avaliacao_id' => $data['avaliacao']->id
        ])->count();
        $avaliacaoCountPerguntas = Avaliacao::withCount('perguntas')->find($data['avaliacao']->id);
        if ($teste != $avaliacaoCountPerguntas->perguntas_count) {
            throw new Exception('Finalizar questionário!');
        }
        $this->avaliacoesEstudantesService->where([
            'student_id'   => $data['student_id'],
            'avaliacao_id' => $data['avaliacao']->id
        ])->update(['concluido' => true]);
        return true;
    }

    public function resultado($user, $avaliacao)
    {
        $concluido = AvaliacoesEstudantes::where([
            'student_id'   => $user->id,
            'avaliacao_id' => $avaliacao->id,
            'concluido'    => true
        ])->get();
        if ($concluido->isEmpty()) {
            return to_route('estudante.index');
        }
        $respostasCorretas = $this->showRepostasCorretas($user, $avaliacao);
        $perguntasCount = $avaliacao->perguntas->count();
        // dd($avaliacao, $perguntasCount, $respostasStudent);
        // dd(compact('avaliacao', 'perguntasCount', 'respostasStudent', 'concluido'));
        return compact('avaliacao', 'perguntasCount', 'respostasCorretas', 'concluido');
    }

    public function showRepostasCorretas($user, $avaliacao): bool|int
    {
        return Respostas::where([
            'student_id'   => $user->id,
            'avaliacao_id' => $avaliacao->id
        ])
            ->whereHas('alternativas', function ($query) {
                $query->where('verdadeiro', true);
            })
            ->count();
    }
}
