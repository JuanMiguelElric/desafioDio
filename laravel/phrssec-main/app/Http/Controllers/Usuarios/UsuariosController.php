<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // \DB::enableQueryLog();

        // dd(\DB::getQueryLog());
        return view('usuarios.index');
    }

    public function indexJson()
    {
        // \DB::enableQueryLog();
        $userData = [];
        foreach (User::lazy() as $usuario) {

            $btnEdit    = '<a href="' . route('usuarios.edit', $usuario->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class = "fa fa-lg fa-fw fa-pen"></i>
                            </a>';
            $btnDelete  = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="' . $usuario->id . '">
                                <i class = "fa fa-lg fa-fw fa-trash"></i>
                            </button>';
            // $btnDetails = '<a href="' . route('usuarios.show', $usuario->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            //                     <i class="fa fa-lg fa-fw fa-eye"></i>
            //                 </a>';

            $userData[] = [
                "id"    => $usuario->id,
                'name'  => $usuario->name,
                'email' => $usuario->email,
                "btns"  => '<nobr>' . $btnEdit . $btnDelete .  '</nobr>'
            ];
        }
        // dd(\DB::getQueryLog());
        return response()->json(['usuarios' => $userData]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        $newUser = User::create($request->validated());
        if ($newUser) {
            return response()->json(['message' => 'novo usuário inserido com sucesso!'], 201);
        }

        return response()->json(['errors' => ['message' => 'Erro ao processar!']], 422);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioAdminRequest $request, User $usuario)
    {
        $usuario->fill($request->validated());
        if ($usuario->save()) {
            return response()->json(['message' => 'Usuário atualizado'], 200);
        }
        return response()->json(['errors' => ['message' => 'erro ao processar']], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id == $id) {
            return response()->json(['errors' => ['message' => 'não foi possivel processar']], 422);
        }
        User::destroy($id);
        return response()->json(['message' => "Dado excluído com sucesso"]);
    }
}
