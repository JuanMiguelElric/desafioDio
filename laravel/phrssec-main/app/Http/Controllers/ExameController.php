<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExameRequest;
use App\Models\Alternativa;
use App\Models\Avaliacao;
use App\Models\AvaliacoesEstudantes;
use App\Models\Respostas;
use App\Models\Student;
use App\Services\ExameService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExameController extends Controller
{
    public function __construct(
        private ExameService $exameService
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('avaliacao')->user();
        $student = Student::with(['avaliacoes' => function ($query) {
            $query->where('concluido', false);
            $query->withCount('perguntas');
        }])->find($user->id);
        $studentConcluido = Student::with(['avaliacoes' => function ($query) {
            $query->where('concluido', true);
            $query->withCount('perguntas');
        }])->find($user->id);
        // dd($student, $studentConcluido);
        return view('exame.index', compact('student', 'studentConcluido'));
    }

    public function exame(string $id)
    {
        try {
            $resultado = $this->exameService->exame($id);
            return view('components.exame', [
                'avaliacao' => $resultado['avaliacao'],
                'perguntas' => $resultado['perguntas'],
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return redirect("/estudante/home");
        }
        // dd($resultado);
        // dd($avaliacao, $perguntas, $alternativas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exame.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExameRequest $request, Avaliacao $avaliacao)
    {
        //fazer a inserção das respostas dos usuários
        $nextPage = $request->nextPage;
        $user = Auth::guard('avaliacao')->user();
        $data = $request->only(['pergunta_id', 'alternativa_id']);
        $data['avaliacao'] = $avaliacao;
        // dd($nextPage);
        try {
            $this->exameService->addResposta(array_merge($data, ['student_id' => $user->id]));
            return redirect("/estudante/avaliacao/{$avaliacao->id}" . "?page=$nextPage");
        } catch (Exception $e) {
            // dd($e);
            return back()->withErrors('não foi possível realizar processamento!');
        }
    }


    public function concluirExame(Request $request, Avaliacao $avaliacao)
    {
        $user = Auth::guard('avaliacao')->user();
        $data['student_id'] = $user->id;
        $data['avaliacao'] = $avaliacao;
        $id = $avaliacao->id;
        try {
            $avaliacao = $this->exameService->concluirExame($data);
            if ($avaliacao) {
                return redirect("/estudante/avaliacao/$id/resultado");
            }
        } catch (Exception $e) {
            return back()->withErrors('Verifique se preencheu todas as questões');
            dd($e);
        }

        // dd($user, $avaliacao);
    }

    /**
     * Display the specified resource.
     */
    public function showResultado(Avaliacao $avaliacao)
    {
        $user = Auth::guard('avaliacao')->user();
        // $concluido = AvaliacoesEstudantes::where([
        //     'student_id'   => $user->id,
        //     'avaliacao_id' => $avaliacao->id,
        //     'concluido'    => true
        // ])->get();
        // if($concluido->isEmpty()){
        //     return to_route('estudante.index');
        // }
        // $respostasStudent = Respostas::where([
        //     'student_id'   => $user->id,
        //     'avaliacao_id' => $avaliacao->id
        // ])
        //     ->whereHas('alternativas', function ($query) {
        //         $query->where('verdadeiro', true);
        //     })
        //     ->count();
        // $perguntasCount = $avaliacao->perguntas->count();
        // // dd($avaliacao, $perguntasCount, $respostasStudent);

        // $this->exameService->resultado($avaliacao);
        // dd(compact('avaliacao', 'perguntasCount', 'respostasStudent', 'concluido'));
        // return view('exame.resultado', compact('avaliacao', 'perguntasCount', 'respostasStudent', 'concluido'));

        $resultado = $this->exameService->resultado($user, $avaliacao);

        // dd($resultado);
        return view('exame.resultado', [
            'avaliacao' => $resultado['avaliacao'],
            'concluido' => $resultado['concluido'],
            'respostasStudent' => $resultado['respostasCorretas'],
            'perguntasCount' => $resultado['perguntasCount'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
