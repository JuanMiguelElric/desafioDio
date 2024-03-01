<?php

namespace App\Http\Controllers\DataMapping\Area;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMapping\Area\StoreAreaRequest;
use App\Http\Requests\DataMapping\Area\UpdateAreaRequest;
use App\Models\Area;
use App\Models\Empresa;
use Exception;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('data-mapping.area.index', compact('empresas'));
    }

    public function buscaPorId(string $id)
    {
        $empresa = Empresa::with('areas')->findOrFail($id);
        $areas = [];
        foreach ($empresa->areas->lazy() as $area) {
            $btnEdit = '<a href="' . route('areas.edit', $area->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="' . $area->id . '">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            // $btnDetails = '<a href="' . route('areas.show', $area->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $area->id . '" title="Details">
            //     <i class="fa fa-lg fa-fw fa-eye"></i>
            // </a>';
            $areas[] = [
                'id'=> $area->id,
                'nome'=> $area->nome,
                'status'=> ($area->status == true)? "ativo": "inativo",
                'created_at'=> $area->created_at->format('d/m/Y H:i:s'),
                'departamentos' => $area->departamentos,
                "btns" => '<nobr>' . $btnEdit . $btnDelete . '</nobr>'
            ];
        }

        return response()->json(['areas'=> $areas]);
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
    public function store(StoreAreaRequest $request)
    {
        try{
            $empresa = Empresa::find($request->safe()->only('empresa')['empresa']);
            $area = new Area($request->safe()->only('nome'));
            // $area = Area::create($request->safe()->only('nome'));
            $empresa->areas()->save($area);
            $empresa->refresh();
            return response()->json(['type'=> 'success', 'message'=> "Area $area->nome incluída em $empresa->nome com sucesso!"]);
        }catch(Exception $e){
            return response()->json(['type'=> 'error', 'message'=> "erro ao incluir $area->nome em $empresa->nome"]);
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
    public function edit(Area $area)
    {
        return view('data-mapping.area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $area->fill($request->validated());
        if($area->save()){
            return response()->json(['type'=> 'success','message'=>"$area->nome atualizado com sucesso!"]);
        }
        return response()->json(['type'=> 'error','message'=>"erro ao atualizar $area->nome!"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $areaNome = $area->nome;
        try{
            $r=Area::destroy($area->id);
            if($r>0){
                return response()->json(['type'=> 'success', 'message'=> "Area $areaNome excluída com sucesso!"]);
            }
            new Exception('Erro ao processar requisição, tente novamente!', 404);
        }catch(Exception $e){
            return response()->json(['type'=> 'error', 'message'=> $e->getMessage()]);
        }
    }
}
