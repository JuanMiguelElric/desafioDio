<?php

namespace App\Http\Controllers\DataMapping\Empresa;

use App\Enums\DataMapping\BaseLegalEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMapping\Empresa\StoreEmpresaRequest;
use App\Http\Requests\DataMapping\Empresa\UpdateEmpresaRequest;
use App\Models\Empresa;
use App\Models\Filial;
use App\Services\Empresa\EmpresaService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function __construct(private EmpresaService $empresaService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-mapping.empresa.index');
    }

    public function empresasJson()
    {
        $empresas = [];
        foreach (Empresa::orderBy('status', 'desc')->orderBy('created_at', 'desc')->lazy() as $empresa) {
            $route = route('empresas.edit', $empresa->id);
            $btnEdit = "<a href='$route' id='$empresa->id' class='btn btn-xs btn-default text-primary mx-1 shadow' title='Edit'>
                <i class='fa fa-lg fa-fw fa-pen'></i>
            </a>";
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Delete" data-dado-id="' . $empresa->id . '">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $btnDetails = '<a href="' . route('empresas.show', $empresa->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $empresa->id . '" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';

            $btnNovoTerceiro = '<a href="' . route('empresas.terceiros.create', $empresa->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $empresa->id . '" title="Add">
            <i class="fa fa-plus" aria-hidden="true"></i>
            </a>';
            $btnTerceiroDetails = '<a href="' . route('empresas.terceiros.index', $empresa->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $empresa->id . '" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';



            $empresas[] = [
                "id"            => $empresa->id,
                "nome"          => $empresa->nome,
                "cnpj"          => preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $empresa->cnpj),
                "telefone"      => preg_replace("/(\d{2})(\d{4,5})(\d{4})/", "(\$1) \$2-\$3", $empresa->telefone),
                "status"        => ($empresa->status == 1 ? "Ativo" : "Inativo"),
                "created_at"    => $empresa->created_at->format('d/m/Y H:i:s'),
                "btns"          => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
                "btn_terceiros" => '<nobr>' . $btnNovoTerceiro . $btnTerceiroDetails . '</nobr>',
            ];
        }

        return response()->json(compact('empresas'));
    }

    public function buscaPorId(string $id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json(
            compact('empresa'),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpresaRequest $request)
    {
        // dd($request->validated());
        $user = Auth::user();
        $data = $request->validated();
        $data['created_by'] = $user->id;
        try {
            if ($this->empresaService->add($data)) {
                return response()->json([
                    'type' => "success",
                    'message' => "Empresa inserida com sucesso!"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'type' => 'error',
                "errors" => [
                    'message' => 'Oops, algo deu errado! Por favor verifique os dados!'
                ]
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        $breadcrumb = [
            ["url" => route('empresas.index'), 'text' => 'empresas'],
            ["url" => route('empresas.edit', $empresa->id), 'text' => "mostrando $empresa->nome"],
        ];
        return view('data-mapping.empresa.show', compact('empresa', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $breadcrumb = [
            ["url" => route('empresas.index'), 'text' => 'empresas'],
            ["url" => route('empresas.edit', $empresa->id), 'text' => "editar $empresa->nome"],
        ];
        return view('data-mapping.empresa.edit', compact('empresa', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {
        // dd($request->validated());
        try {
            $data = [];
            foreach ($request->validated() as $key => $value) {
                $novaChave = str_replace('edit_', "", $key);
                // dd('key: '.$key, 'valor: '.$value,'Nova Chave: '. $novaChave);
                $data[$novaChave] = $value;
            }
            if (isset($data['filial']) && count($data['filial']) > 0) {
                DB::transaction(function () use ($data, $empresa) {
                    foreach ($data['filial'] as $filial) {
                        $filialOb = $empresa->filiais()->findOrNew($filial['id']);
                        $filialOb->nome = $filial['nome'];
                        $filialOb->cnpj = $filial['cnpj'];
                        $empresa->filiais()->save($filialOb);
                    }
                });
            }
            $empresa->fill($data);
            $empresa->save();
            return to_route('empresas.edit', ['empresa' => $empresa->id])->with('message', ['message' => 'empresa atualizada com sucesso', 'type' => 'success']);
        } catch (Exception $e) {
            return to_route('empresas.edit', ['empresa' => $empresa->id])->with('message', ['message' => 'Ops! algo deu errado.', 'type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $empresa = Empresa::find($id);
        $empresa->terceiros()->delete();
        if ($empresa->delete()) {
            return response()->json(['type' => 'success', 'message' => 'empresa exluida com sucesso!']);
        }
        return response()->json(['type' => 'error', 'message' => 'Erro ao excluir!']);
    }
}
