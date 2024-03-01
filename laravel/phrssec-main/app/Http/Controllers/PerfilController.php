<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = session('message');
        $user = Auth::user();
        return view('perfil.index', compact('user','message'));
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
    public function store(Request $request)
    {
        //
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
    public function update(UpdateUsuarioRequest $request, string $id)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        // Certifique-se de que o usuário logado está tentando atualizar o próprio avatar.
        if ($id == $user->id) {
            if($request->file('avatar')){
                
                if ($user->photo) {
                    Storage::delete($user->photo);
                }
                // Verifique se um avatar anterior existe e exclua-o.
                
                // Armazene o novo avatar.
                $path = $request->file('avatar')->store('public/avatars');
                
                // Atualize o campo 'photo' no banco de dados.
                $user->update(['photo' => $path]);
            }
            
            $user->update(['name'=>$request->name, 'terms'=>true]);

            return back()->with('success', 'Avatar atualizado com sucesso');
        }

        return back()->with('error', 'Você não tem permissão para atualizar o avatar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
