<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordUsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function handle(UpdatePasswordUsuarioRequest $request, User $user)
    {
        $user->fill([
            'password' => Hash::make($request->validated('password'))
        ]);
        if (!$user->save()) {
            return back()->withErrors('erro ao processar!');
        }
        // $when = now()->addSeconds(10);
        // Mail::to($user)->later($when, new ChangePassword($user));
        return back()->with('message', 'Senha alterada com sucesso!');
    }
}
