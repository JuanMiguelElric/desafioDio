<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerguntaRequest;
use App\Http\Requests\UpdatePerguntaRequest;
use App\Models\Avaliacao;
use App\Models\Pergunta;
use App\Services\AvaliacaoService;
use App\Services\PerguntaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PerguntaController extends Controller
{
    public function __construct(private AvaliacaoService $avaliacao, private PerguntaService $pergunta)
    {
        # code...
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaliacoes = Avaliacao::all();
        return view('perguntas.index', ['avaliacoes' => $avaliacoes]);
    }
    public function perguntasJson(string $id): JsonResponse
    {
        $avaliacao = $this->avaliacao->findById($id);
        if (!$avaliacao) {
            return response()->json(['info' => 'avaliação inválida!']);
        }
        $perguntas = $avaliacao->perguntas()->all();
        return response()->json([
            'success' => 'perguntas encontradas com sucesso!',
            'perguntas' => $perguntas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $avaliacoes = Avaliacao::all();
        return view('perguntas.create', ['avaliacoes' => $avaliacoes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePerguntaRequest $request)
    {
        $avaliacao = $this->avaliacao->findById($request->avaliacao);
        if (!$avaliacao) {
            return response()->json(['info' => 'avaliação inválida!']);
        }
        $pergunta = new Pergunta(['titulo' => $request->titulo]);
        $avaliacao->perguntas()->save($pergunta);
        return response()->json(['success' => 'Pergunta salva com sucesso!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pergunta $pergunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pergunta $pergunta)
    {
        return view('perguntas.edit', ['pergunta' => $pergunta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerguntaRequest $request, Pergunta $pergunta)
    {
        $pergunta->titulo = $request->titulo;
        $pergunta->save();
        return redirect('/perguntas')->with('Questão atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pergunta $pergunta)
    {
        $perguntaTitulo = $pergunta->titulo;
        $pergunta->delete();
        return response()->json(['success' => "$perguntaTitulo excluída com sucesso!"], 200);
    }
}
