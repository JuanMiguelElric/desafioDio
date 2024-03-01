<?php

namespace App\Services;

use App\Models\Avaliacao;
use App\Models\AvaliacoesEstudantes;
use App\Models\Respostas;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvaliacaoService implements AllService
{
    public function __construct(private Avaliacao $avaliacao)
    {
    }

    public function add(array $data): Avaliacao|bool
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $avaliacao = new Avaliacao(array_merge($data, ['created_by_user_id' => $user->id]));
        $resultado = $avaliacao->save();
        if ($resultado == false) {
            throw new Exception('Não foi possível cadastrar avaliação!', 400);
            return false;
        }
        // dd($avaliacao);
        return $avaliacao;
    }

    public function findById(string $id): Avaliacao|bool
    {
        $avaliacao = $this->avaliacao->find($id);
        if ($avaliacao) {
            return $avaliacao;
        }
        throw new Exception('Avaliação não encontrada!');
    }

    public function update(array $data, string $id): Avaliacao
    {
        $avaliacao = $this->findById($id);
        // dd($data);
        $avaliacao->update([
            'titulo' => $data['titulo'],
            'ativo'  => $data['ativo']
        ]);
        return $avaliacao;
    }

    public function destroy(string $id): int|bool
    {
        if ($this->avaliacao->destroy($id) == 0) {
            throw new Exception('Não foi possível apagar a avaliação', 400);
            return false;
        }
        return true;
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return array|boolean
     */
    public function buscaAvaliacaoStudents(string $id): array|bool
    {


        // DB::EnableQueryLog();
        // $avaliacao = $this->avaliacao::withCount(['students', 'perguntas', 'students as students_concluido' => function ($query) {
        //     $query->where('concluido', true);
        // }])->with(['avaliacoes_estudantes' => function ($query) {
        //     $query->latest()->take(3);
        // }])->find($id);

        // $estudantes = $this->avaliacao::with(['avaliacoes_estudantes'=> function($query){
        //     $query->latest()->take(3);
        // }])->orderBy('created_at', 'DESC')->find($id);
        // dd($estudantes);

        $avaliacao = AvaliacoesEstudantes::where('avaliacao_id', $id)
            ->join('students', 'avaliacoes_estudantes.student_id', '=', 'students.id')
            ->join('avaliacoes', 'avaliacoes_estudantes.avaliacao_id', '=', 'avaliacoes.id')
            ->orderBy('avaliacoes_estudantes.created_at', 'desc')
            ->take(3)
            ->select(
                [
                    'avaliacoes_estudantes.*',
                    // 'students.*',
                    // 'avaliacoes.*',
                    'students.id as students_id',
                    'students.name as students_name',
                    'students.photo as students_photo',
                    'avaliacoes.id as avaliacoes_id',
                    'avaliacoes.titulo as avaliacoes_titulo',
                    'avaliacoes.created_by_user_id as avaliacoes_created_by_user_id'
                ]
            )
            ->get();

        $avaliacaoCounts = Avaliacao::withCount(['students', 'perguntas', 'students as students_concluido' => function ($query) {
            $query->where('concluido', true);
        }])->find($id);


        // dd($avaliacao, $avaliacaoCounts,DB::getQueryLog());

        if (!$avaliacao) {
            throw new Exception('Não foi possível trazer a avaliação no momento!');
        }

        $createdBy = User::find($avaliacaoCounts->created_by_user_id);
        return [$avaliacao, $avaliacaoCounts, $createdBy];
    }

    public function buscaAlunosConcluido(Avaliacao $avaliacao)
    {
        $avaliacaoConcluidos = Avaliacao::with(['students' => function ($query) {
            $query->where('concluido', true);
        }])->find($avaliacao->id);
        return $avaliacaoConcluidos;
    }

}
