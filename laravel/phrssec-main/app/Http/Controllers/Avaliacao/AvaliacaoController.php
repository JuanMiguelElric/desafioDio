<?php

namespace App\Http\Controllers\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Http\Requests\StoreAvaliacaoRequest;
use App\Http\Requests\UpdateAvaliacaoRequest;
use App\Models\User;
use App\Services\AvaliacaoService;
use App\Services\ExameService;
use Exception;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;

class AvaliacaoController extends Controller
{
    public function __construct(
        private AvaliacaoService $avaliacaoService, 
    private ExameService $exameService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Avaliacao::with('perguntas'));
        return view('avaliacao.index');
    }
    public function indexJson()
    {
        $avaliacaoData = [];
        foreach (Avaliacao::withCount('perguntas')->lazy() as $avaliacao) {

            
            $btnEdit = '<a href="' . route('avaliacoes.edit', $avaliacao->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="' . $avaliacao->id . '">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $btnDetails = '<a href="' . route('avaliacoes.show', $avaliacao->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $avaliacao->id . '" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';

            $avaliacaoData[] = [
                "id" => $avaliacao->id,
                'titulo' => $avaliacao->titulo,
                'cliente' => $avaliacao->cliente,
                'total' => $avaliacao->perguntas_count,
                "btns" => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
            ];
        }
        return response()->json(['avaliacoes' => $avaliacaoData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $success = session('success');
        return view('avaliacao.create', ['success' => $success]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvaliacaoRequest $request)
    {
        try {
            $avaliacao = $this->avaliacaoService->add($request->safe()->only(['titulo', 'descricao', 'cliente']));
            if ($request->json === 'true' && $avaliacao) {
                return response()->json([
                    'status_code'  => 201,
                    'message' => 'Avaliação criada com sucesso!',
                ], 201);
            }

            if ($avaliacao) {
                return back()->with('success', 'Avaliação gerada com sucesso!');
            }
            return back()->with('error', 'Erro ao processar avaliação!');
        } catch (Exception $e) {
            return response()->json([
                'status_code' => $e->getCode(),
                'message'     => $e->getMessage()
            ], $e->getCode());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //trazer contagem total de estudante, perguntas e quantos terminaram a avaliação

        try {
            $resultado = $this->avaliacaoService->buscaAvaliacaoStudents($id);
            // dd($resultado);
            return view('avaliacao.show', ['avaliacao_estudantes' => $resultado[0], 'avaliacao' => $resultado[1], 'created_by_user' => $resultado[2]->name]);
        } catch (Exception $e) {
            // dd($e);
            return view('404');
        }
    }

    public function showEstudanteConcluidos(Avaliacao $avaliacao): JsonResponse
    {
        // dd($avaliacao);
        $avaliacao = $this->avaliacaoService->buscaAlunosConcluido($avaliacao);
        if (!$avaliacao) {
            return response()->json([
                'code'    => '404',
                'message' => 'NotFound'
            ], 404);
        }
        $avaliacaoArr = [];
        $perguntaCount = $avaliacao->perguntas->count();
        foreach ($avaliacao->students as $student) {
            $rCorreta = $this->exameService->showRepostasCorretas($student, $avaliacao);
            $porcentagem = ($rCorreta/$perguntaCount) * 100;
            array_push($avaliacaoArr, [
                'id'         => $student->id,
                'name'       => $student->name,
                'email'      => $student->email,
                'resultado'  => "$rCorreta/$perguntaCount | ".number_format($porcentagem, 2)."%",
                'updated_at' => $student->pivot->updated_at->format('d/m/Y H:i:s')
            ]);
        }
        return response()->json([
            'estudantes' => $avaliacaoArr
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $avaliacao = $this->avaliacaoService->findById($id);
            if ($avaliacao == false) {
                return redirect('/avaliacoes');
            }
            return view('avaliacao.edit', ['avaliacao' => $avaliacao]);
        } catch (Exception $e) {
            return view('404');
        }
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAvaliacaoRequest $request, string $id)
    {
        $avaliacao = $this->avaliacaoService->update($request->all(), $id);
        if ($avaliacao) {
            return response()->json(['success' => 'Avaliação editada com sucesso!'], 200);
        }
        return response()->json(['error' => 'Erro ao editar avaliação, avisar suporte!'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($this->avaliacaoService->destroy($id) >= 1) {
                return response()->json([
                    "status" => 200,
                    'success' => "Avaliação excluída com sucesso!"
                ], 200);
            }
            return response()->json([
                "status" => 400,
                'success' => "Não foi possível processar sua requisição!"
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                'success' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
