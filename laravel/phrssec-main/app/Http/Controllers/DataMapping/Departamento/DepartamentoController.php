<?php

namespace App\Http\Controllers\DataMapping\Departamento;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMapping\Departamento\StoreDepartamentoRequest;
use App\Http\Requests\DataMapping\Departamento\UpdateDepartamentoRequest;
use App\Models\Area;
use App\Models\Departamento;
use App\Models\Empresa;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('departamentos.index'), 'text' => "Departamentos"],
        ];

        return view('data-mapping.departamento.index', compact('empresas', 'breadcrumb'));
    }

    public function areaDepartamentoBuscaPorId(Area $area)
    {
        $departamentos = $area->departamentos;
        if ($departamentos->isEmpty()) {
            return response()->json(['type' => 'info', 'message' => "Departamento não encontrado!"], 404);
        }
        $departamentosArr = [];
        foreach ($departamentos as $departamento) {
            $btnEdit = '<a href="' . route('departamentos.edit', $departamento->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="' . $departamento->id . '">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            // $btnDetails = '<a href="' . route('departamentos.show', $departamento->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $departamento->id . '" title="Details">
            //     <i class="fa fa-lg fa-fw fa-eye"></i>
            // </a>';
            $departamentosArr[] = [
                'id'          => $departamento->id,
                'nome'        => $departamento->nome,
                'responsavel' => $departamento->responsavel,
                'telefone'    => $departamento->telefone,
                'email'       => strtolower($departamento->email),
                'criado'      => $departamento->created_at->format('d/m/Y H:i:s'),
                'atualizado'  => $departamento->updated_at->format('d/m/Y H:i:s'),
                "acoes"       => '<nobr>' . $btnEdit . $btnDelete . '</nobr>'
            ];
        }
        return response()->json(['type' => 'success', 'departamentos' => $departamentosArr], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartamentoRequest $request)
    {
        try {
            $area = Area::find($request->safe()->only('area')['area']);
            if (is_null($area)) {
                throw new Exception("No query Result", 404);
            }
            $area->departamentos()->create($request->safe(['nome', 'responsavel', 'telefone', 'email']));
            return response()->json([
                'type' => 'success',
                'message' => 'departamento inserido com sucesso!'
            ], 201);
            // dd($area, $request->validated());
        } catch (Exception $e) {
            return response()->json([
                "type"   => "error",
                "errors" => [
                    'notfound' => $e->getMessage()
                ]
            ], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit(Departamento $departamento)
    {
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('departamentos.index'), 'text' => "Departamentos"],
            ['url' => route('departamentos.edit', $departamento->id), 'text' => "$departamento->nome"],
        ];
        return view('data-mapping.departamento.edit', compact('departamento','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartamentoRequest $request, Departamento $departamento)
    {
        $departamento->update($request->validated());
        return to_route('departamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        if($departamento->delete()){
            return response()->json(['type' => 'success', 'message' => "$departamento->nome excluído com sucesso"]);
        }
        return response()->json(['type' => 'error', 'message' => "Erro ao excluir $departamento->nome"]);
    }
}
