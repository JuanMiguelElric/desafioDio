<?php

namespace App\Http\Controllers\Alternativa;

use App\Http\Controllers\Controller;
use App\Models\Alternativa;
use App\Http\Requests\StoreAlternativaRequest;
use App\Http\Requests\UpdateAlternativaRequest;
use App\Models\Avaliacao;
use App\Models\Pergunta;
use App\Services\AlternativaService;
use Illuminate\Support\Facades\Auth;

class AlternativaController extends Controller
{
    public function __construct(private AlternativaService $alternativaService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('alternativas.index', ['avaliacoes' => Avaliacao::all()]);
    }
    
    public function indexPerguntaWithAlternativas(string $id)
    {
        $avaliacao = Avaliacao::with('perguntas')->find($id);
        $perguntas = $avaliacao->perguntas()->with('alternativas')->get();
        if ($perguntas) {
            return response()->json(['perguntas' => $perguntas]);
        }
        return response()->json(['errors' => 'perguntas e/ou alternativas nao encontradas!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $avaliacoes = Avaliacao::all();
        return view('alternativas.create', [
            'avaliacoes' => $avaliacoes,
        ]);
    }

    public function createJsonPerguntas(string $id)
    {
        $avaliacao = Avaliacao::with('perguntas')->find($id);

        if (!$avaliacao->perguntas->isEmpty()) {
            return response()->json(['perguntas' => $avaliacao->perguntas]);
        }
        return response()->json([
            'perguntas' => "selecionar ...",
            'error' => "Pergunta not found!"
        ], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlternativaRequest $request)
    {
        $alternativaOrFalse = $this->alternativaService->add($request->only('avaliacao', 'pergunta', 'opcao', 'verdadeiro'));
        if (!$alternativaOrFalse) {
            return response()->json(['errors' => ['process' => 'erro ao processar alternativa']], 406);
        }
        return response()->json(['success' => 'Alternativa gerada com sucesso!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternativa $alternativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternativa $alternativa)
    {
        return view('alternativas.edit', ['alternativa' => $alternativa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlternativaRequest $request, Alternativa $alternativa)
    {
        if ($request->json === '1') {
            $alternativa->opcao = $request->opcao;
            $alternativa->verdadeiro = $request->verdadeiro;
            $alternativa->save();
            return response()->json([
                'status'  => 'success',
                'message' => 'alternativa atualizada!',
                'data'    => [
                    'id'         => $alternativa->id,
                    'opcao'      => $alternativa->opcao,
                    'verdadeiro' => $alternativa->verdadeiro
                ]
            ]);
        }

        $alternativa->opcao = $request->opcao;
        $alternativa->verdadeiro = $request->verdadeiro;
        $alternativa->save();
        return to_route('alternativas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternativa $alternativa)
    {
        $alternativa->delete();
        return response()->json(
            [
                'status'=>'success',
                'message'=>'Alternativa excluida com sucesso',
            ],
            200
        );
    }
}
