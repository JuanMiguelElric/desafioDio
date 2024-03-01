<?php

namespace App\Http\Controllers\DataMapping\Terceiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMapping\Terceiro\StoreTerceiroRequest;
use App\Http\Requests\DataMapping\Terceiro\UpdateTerceiroRequest;
use App\Models\Empresa;
use App\Models\Terceiro;
use Exception;
use Illuminate\Http\Request;

class TerceiroController extends Controller
{
    public function indexPaginateTerceiros(Empresa $empresa, $limit)
    {
        $allowedLimits = [10, 50, 100];
        if (!in_array($limit, $allowedLimits)) {
            // Se o valor de $limit não for permitido, defina um valor padrão (por exemplo, 10)
            $limit = 10;
        }
    
        $breadcrumb = [
            ["url" => route('empresas.index'), 'text' => 'Empresas'],
            ["url" => route('empresas.terceiros.index', $empresa->id), 'text' => 'Terceiros'],
        ];
    
        $terceiros = $empresa->terceiros()->paginate($limit);
        return view('data-mapping.terceiro.indexTerceiros', compact('empresa', 'terceiros', 'allowedLimits', 'limit', 'breadcrumb'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Empresa $empresa)
    {
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('empresas.terceiros.index', $empresa->id), 'text' => 'Terceiros']
        ];
        return view('data-mapping.terceiro.index', compact('empresa', 'breadcrumb'));
    }

    public function indexJson(Request $request, Empresa $empresa)
    {
        
        $terceiros = $empresa->terceiros->lazy();
        // dd($terceiros);
        if ($terceiros->isEmpty()) {
            return response()->json(['type' => "error", "terceiros" => []], 200);
        }
        $terceirosArr = [];
        foreach ($terceiros as $terceiro) {
            $route = route('terceiros.edit', $terceiro->id);
            $btnEdit = "<a href='$route' id='$terceiro->id' class='botao-edit btn btn-xs btn-default text-primary mx-1 shadow' title='Editar'>
                <i class='fa fa-lg fa-fw fa-pen'></i>
            </a>";
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Delete" data-dado-id="' . $terceiro->id . '">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $btnDetails = '<a href="' . route('terceiros.show', $terceiro->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $terceiro->id . '" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';
            // dd($cnpj);
            $terceirosArr[] = [
                'id'          => $terceiro->id,
                'cod'         => $terceiro->cod,
                'nome'        => $terceiro->nome_terceiro,
                'site'        => "<a href='$terceiro->site_terceiro' target='_blank'>$terceiro->site_terceiro</a>",
                'cnpj'        => preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $terceiro->cnpj_terceiro),
                'email'       => $terceiro->email_do_representante,
                'responsavel' => $terceiro->nome_do_representante,
                "btns"        => "<nobr>" . $btnEdit . $btnDelete . $btnDetails . "</nobr>"
            ];
        }
        return response()->json(['terceiros' => $terceirosArr]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Empresa $empresa)
    {
        $areas = $empresa->areas;
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('empresas.terceiros.index', $empresa->id), 'text' => 'Terceiros'],
            ['url' => route('empresas.terceiros.create', $empresa->id), 'text' => 'Novo terceiro'],
        ];
        return view('data-mapping.terceiro.create', compact('areas', 'empresa','breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTerceiroRequest $request, Empresa $empresa)
    {
        $obTerceiro = new Terceiro($request->validated());
        // dd($obTerceiro);
        if($empresa->terceiros()->save($obTerceiro) == false){
            if($request->json == 1){
                return response()->json(['type' => 'error', 'message' => 'Oops.. Erro ao processar!'], 400);
            }
            return back('empresas.terceiros.create', ['empresa' => $empresa->id], 302)->withErrors('Erro ao processar');
        }
        if ($request->json ==  1) {
            return response()->json(['type' => 'success', 'message' => 'Terceiro inserido com sucesso!'], 201);
        }
        return to_route('empresas.terceiros.index', ['empresa' => $empresa->id], 302);
    }

    /**
     * Display the specified resource.
     */
    public function show(Terceiro $terceiro)
    {
        $empresa = $terceiro->empresa;
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('empresas.terceiros.index', $empresa->id), 'text' => 'Terceiros'],
            ['url' => route('empresas.terceiros.create', $empresa->id), 'text' => "$terceiro->nome_terceiro"],
        ];
        return view('data-mapping.terceiro.show', compact('terceiro', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terceiro $terceiro)
    {
        return view('data-mapping.terceiro.edit', compact('terceiro'));
    }

    public function editJson(Terceiro $terceiro)
    {
        // dd($terceiro);
        return response()->json(compact('terceiro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTerceiroRequest $request, Terceiro $terceiro)
    {
        // foreach ($request->validated() as $key => $value) {
        //     $novaChave = str_replace('edit_', "", $key);
        //     // dd('key: '.$key, 'valor: '.$value,'Nova Chave: '. $novaChave);
        //     $data[$novaChave] = $value;
        // }
        $empresa = $terceiro->empresa;
        try {
            $terceiro->update($request->validated());
            if($request->json == 1){
                return response()->json(['type' => 'success', 'message' => "$terceiro->nome_terceiro atualizado com sucesso!"]);
            }
            return to_route('empresas.terceiros.index',$empresa->id);
        } catch (Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terceiro $terceiro)
    {
        if ($terceiro->delete()) {
            return response(['type' => 'success', 'message' => "$terceiro->nome_terceiro excluido!"], 200);
        }
        return response(['type' => 'error', 'message' => 'Erro ao excluir terceiro!'], 400);
    }
}
