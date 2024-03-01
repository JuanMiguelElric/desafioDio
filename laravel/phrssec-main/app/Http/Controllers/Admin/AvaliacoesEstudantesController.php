<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\AvaliacoesEstudantes;
use App\Models\Student;
use App\Services\AvaliacaoService;
use App\Services\AvaliacoesEstudantesService;
use App\Services\StudentService;
use Exception;
use Illuminate\Http\Request;


class AvaliacoesEstudantesController extends Controller
{
    public function __construct(
        private AvaliacoesEstudantesService $avaliacoesEstudantesService
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaliacoes = Avaliacao::all();
        // dd($avaliacoes);
        return view('Admin.avaliacoes', ['avaliacoes' => $avaliacoes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $avaliacoes = Avaliacao::all();
        $estudantes = Student::all();
        return view('Admin.student-avaliacao', ['avaliacoes' => $avaliacoes, 'estudantes' => $estudantes]);
    }

    public function searchEstudantes(string $text)
    {
        return response()->json(['estudantes' => Student::find(['email' => $text])]);
    }

    /**
     * Atribuir Avaliação ao estudante
     */
    public function store(Request $request)
    {
        //verifica se o estudante já está atríbuido na avaliação
        $validated = $request->validate([
            'avaliacao' => 'required|numeric',
            'estudante' => 'required|numeric|min:1'
        ]);
        try {
            $resposta = $this->avaliacoesEstudantesService->add($validated);
            if ($resposta) {
                return response()->json([
                    'status_code' => 201,
                    'message'     => 'Cadastro do aluno no sistema concluído!'
                ]);
            }
            return response()->json([
                'status_code' => 404,
                'message'     => 'não foi possível cadastrar aluno no curso'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => $e->getCode(),
                'message'     => $e->getMessage(),
            ], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
