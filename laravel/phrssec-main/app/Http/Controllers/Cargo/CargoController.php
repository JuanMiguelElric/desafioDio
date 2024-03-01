<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cargo\Storecargo;
use App\Http\Requests\cargo\UpdateCargo;
use App\Models\Cargo;
use App\Models\Empresa;
use Exception;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function IndexPaginaCargo(Empresa $empresa, $limite) {
        $limitesPermitidos = [10, 50, 100];
        if (!in_array($limite, $limitesPermitidos)) {
            $limite = 10;
        }
        $breadcrumb = [
            ["url" => route('empresas.index'), 'text' => 'Empresa'],
            ["url" => route('empresas.cargo.index', $empresa->id), 'text' => 'cargo']
        ];
        $cargo = $empresa->cargos()->paginate($limite);
        return view('data-mapping.cargo.index', compact('empresa', 'cargo', 'limite', 'breadcrumb', 'limitesPermitidos'));
    }
    public function create(Empresa $empresa){
        $collaborators =  $empresa->collaborator;
        $breadcrumb = [
            ['url'=> route('empresas.index'),'text'=>'Empresas'],
            ['url' => route('empresas.cargo.index', $empresa->id), 'text' => 'cargo'],
            ['url'=> route('empresas.cargo.create',$empresa->id), 'text'=>'cargo'],
        ];
        return view('data-mapping.cargo.create',compact('collaborators','empresa','breadcrumb'));

    }

    public function store(Storecargo $request, Empresa $empresa)
    {
        $data = $request->validated(); 
    
        
        $cargo = new Cargo($data);
    

        if ($empresa->cargos()->save($cargo)) {
         
            if ($request->json == 1) {
                return response()->json(['type' => 'success', 'message' => 'Cargo inserido com sucesso!'], 201);
            }
            return redirect()->route('empresas.cargo.index', ['empresa' => $empresa->id]);
        }
    
        // Se a operação de salvamento falhar
        if ($request->json == 1) {
            return response()->json(['type' => 'error', 'message' => 'Erro no processamento'], 400);
        }
        return back()->withErrors("Erro ao processar");
    }
    //page de edit
    public function edit(Cargo $cargo){
        return view('data-mapping.cargo.EditCargo',compact('cargo'));
    }
    public function index(Empresa $empresa){
        $breadcrumb =[
            ['url'=> route('empresas.index'), 'text'=> 'Empresa'],
            ['url'=> route('empresas.cargo.index',$empresa->id), 'text' => 'Cargo']
        ];
        return view('data-mapping.cargo.index',compact('empresa','breadcrumb'));
    }
    public function indexJson(Request $request, Empresa $empresa){
        $cargos = $empresa->cargos->lazy();
        if($cargos->isEmpty()){
            return response()->json(["type"=>"error","cargos"=>[]],200);
        }
        $cargoArr = [];
        foreach ($cargos as $cargo) {
            # code...
       
            $route = route('cargo.edit',$cargo->id);
            $btnedit= "<a href='$route' id='$cargo->id' class='botao-edit btn btn-xs btn-default text-primary mx-1 shadow' title='Editar'>
                    <i class='fa fa-lg fa-fw fa-pen'></i>
                </a>";
            $btndelet = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Delete" data-dado-id="' . $cargo->id . '">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
            $btnDetails = '<a href="' . route('pessoa.show', $cargo->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $cargo->id . '" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';

        

            $cargoArr[] =[
                'id' => $cargo->id,
                'nome_do_cargo' => $cargo->nome_do_cargo,
                
                'btns'        => '<nobr>' . $btnedit . $btndelet . $btnDetails . '</nobr>',

            ];
        }
        return response()->json(['cargos'=>$cargoArr]);

    }
    public function show(Cargo $cargo)
    {
        $empresa = $cargo->empresa;
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('empresas.cargo.index', $empresa->id), 'text' => 'cargos'],
            ['url' => route('empresas.cargo.create', $empresa->id), 'text' => "$cargo->nome_do_cargo"],
        ];
        return view('data-mapping.pessoa.show', compact('cargo', 'breadcrumb'));
    }
    public function update(UpdateCargo $request, Cargo $cargo)
    {
        
        $empresa = $cargo->empresa;
        
        try {
            // Validar os dados recebidos do formulário
            $dadosValidados = $request->validated();
            
            
            $cargo->update($dadosValidados);
            
            if ($request->json == 1) {
                
                return response()->json([
                    "type" => 'success',
                    "message" => "$cargo->nome_do_cargo atualizado com sucesso!"
                ]);

            } else {
                
                return redirect()->route('empresas.cargo.index', $empresa->id);
            }
        } catch (Exception $e) {
            
            return response()->json(["type" => "error", "message" => $e->getMessage()]);
        }
    }

    public function destroy(Cargo $cargo)
    {
        $CargoNome = $cargo->nome_do_cargo;
        try{
            $r=Cargo::destroy($cargo->id);
            if($r>0){
                return response()->json(['type'=> 'success', 'message'=> "Area $CargoNome excluída com sucesso!"]);
            }
            new Exception('Erro ao processar requisição, tente novamente!', 404);
        }catch(Exception $e){
            return response()->json(['type'=> 'error', 'message'=> $e->getMessage()]);
        }
    }

}
