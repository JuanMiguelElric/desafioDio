<?php

namespace App\Http\Controllers\DataMapping\pessoa;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMapping\Pessoa\StorePessoaRequest;
use App\Http\Requests\DataMapping\Pessoa\UpdatePessoa;
use App\Models\Empresa;
use App\Models\Pessoa;
use Database\Seeders\EmpresaSeeder;
use Exception;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function IndexPaginaPessoa(Empresa $empresa, $limite) {
        $limitesPermitidos = [10, 50, 100];
        if (!in_array($limite, $limitesPermitidos)) {
            $limite = 10;
        }
        $breadcrumb = [
            ["url" => route('empresas.index'), 'text' => 'Empresa'],
            ["url" => route('empresas.pessoa.index', $empresa->id), 'text' => 'Colaborador']
        ];
        $pessoa = $empresa->pessoas()->paginate($limite);
        return view('data-mapping.pessoa.index', compact('empresa', 'pessoa', 'limite', 'breadcrumb', 'limitesPermitidos'));
    }
    public function index(Empresa $empresa){
        $breadcrumb =[
            ['url'=> route('empresas.index'), 'text'=> 'Empresa'],
            ['url'=> route('empresas.pessoa.index',$empresa->id), 'text' => 'Colaborador']
        ];
        return view('data-mapping.pessoa.index',compact('empresa','breadcrumb'));
    }
    
    public function create(Empresa $empresa){
        $collaborators =  $empresa->collaborator;
        $breadcrumb = [
            ['url'=> route('empresas.index'),'text'=>'Empresas'],
            ['url' => route('empresas.pessoa.index', $empresa->id), 'text' => 'pessoa'],
            ['url'=> route('empresas.pessoa.create',$empresa->id), 'text'=>'pessoa'],
        ];
        return view('data-mapping.pessoa.create',compact('collaborators','empresa','breadcrumb'));

    }
    public function indexJson(Request $request, Empresa $empresa){
        $pessoas = $empresa->pessoas->lazy();
        if($pessoas->isEmpty()){
            return response()->json(["type"=>"error","pessoas"=>[]],200);
        }
        $pessoaArr = [];
        foreach ($pessoas as $pessoa) {
            # code...
            $whatsapp = $pessoa->whatsapp ? 'Sim' : 'Não';
            $route = route('pessoa.edit',$pessoa->id);
            $btnedit= "<a href='$route' id='$pessoa->id' class='botao-edit btn btn-xs btn-default text-primary mx-1 shadow' title='Editar'>
                    <i class='fa fa-lg fa-fw fa-pen'></i>
                </a>";
            $btndelet = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Delete" data-dado-id="' . $pessoa->id . '">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
            $btnDetails = '<a href="' . route('pessoa.show', $pessoa->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $pessoa->id . '" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
            $btnCargo = '<a href="' . route('empresas.cargo.create', $empresa->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $empresa->id . '" title="Add">
            <i class="fa fa-plus" aria-hidden="true"></i>
            </a>';
            $btnCargoDetails = '<a href="' . route('empresas.cargo.index', $empresa->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $empresa->id . '" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';
        

            $pessoaArr[] =[
                'id' => $pessoa->id,
                'nome_completo' => $pessoa->nome_completo,
                'nome_social'=>$pessoa->nome_social,
                'cpf'=> $pessoa->cpf,
                'telefone'=> $pessoa->telefone,
                'whatsapp'=> $whatsapp,
                'btns'        => '<nobr>' . $btnedit . $btndelet . $btnDetails . '</nobr>',
                'btns_cargos'        => '<nobr>' . $btnCargo . $btnCargoDetails . '</nobr>'
            ];
        }
        return response()->json(['pessoas'=>$pessoaArr]);

    }
    public function store(StorePessoaRequest $request, Empresa $empresa)
    {
        $data = $request->validated(); 
    
        
        $pessoa = new Pessoa($data);
    

        if ($empresa->pessoas()->save($pessoa)) {
         
            if ($request->json == 1) {
                return response()->json(['type' => 'success', 'message' => 'pessoa inserido com sucesso!'], 201);
            }
            return redirect()->route('empresas.pessoa.index', ['empresa' => $empresa->id]);
        }
    
        // Se a operação de salvamento falhar
        if ($request->json == 1) {
            return response()->json(['type' => 'error', 'message' => 'Erro no processamento'], 400);
        }
        return back()->withErrors("Erro ao processar");
    }
    public function edit(Pessoa $pessoa){
        return view('data-mapping.pessoa.EditPessoa', compact('pessoa'));

    }
    public function editJson(Pessoa $pessoa){
        return response()->json(compact('pessoa'));
    }

    public function update(UpdatePessoa $request, Pessoa $pessoa)
    {
        
        $empresa = $pessoa->empresa;
        
        try {
            // Validar os dados recebidos do formulário
            $dadosValidados = $request->validated();
            
            
            $pessoa->update($dadosValidados);
            
            if ($request->json == 1) {
                
                return response()->json([
                    "type" => 'success',
                    "message" => "$pessoa->nome_completo atualizado com sucesso!"
                ]);
            } else {
                
                return redirect()->route('empresas.pessoa.index', $empresa->id);
            }
        } catch (Exception $e) {
            
            return response()->json(["type" => "error", "message" => $e->getMessage()]);
        }
    }
    
    public function show(Pessoa $pessoa)
    {
        $empresa = $pessoa->empresa;
        $breadcrumb = [
            ['url' => route('empresas.index'), 'text' => 'Empresas'],
            ['url' => route('empresas.pessoa.index', $empresa->id), 'text' => 'Pessoas'],
            ['url' => route('empresas.pessoa.create', $empresa->id), 'text' => "$pessoa->nome_completo"],
        ];
        return view('data-mapping.pessoa.show', compact('pessoa', 'breadcrumb'));
    }
    public function destroy(Pessoa $pessoa){
        if($pessoa->delete()){
            return response(["type"=>"succes", "message"=>"$pessoa->nome_completo excluido com sucesso!"]);
        }
        return response(["type"=> "error", "message"=>"Erro ao excluir pessoa"]);

    }
}
