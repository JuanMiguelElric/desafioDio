<?php

namespace App\Http\Controllers\Estudantes;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUsuarioRequest;
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
        $user = Auth::guard('avaliacao')->user();
        $message = session('message');
        $error = session('error');
        return view('perfil.index', compact('user', 'message','error'));
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
        // dd('teste');
        /**
         * @var Student $user
         */
        $user = Auth::guard('avaliacao')->user();
       
        // Certifique-se de que o usuário logado está tentando atualizar o próprio avatar.
        // dd($request);
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

            return back()->with('message', 'Perfil atualizado com sucesso');
        }

        return back()->with('error', 'Você não tem permissão para atualizar o Perfil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
