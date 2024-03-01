<?php

use Illuminate\Support\Facades\Route;

Route::prefix('estudante')->group(function () {
    Route::middleware(['auth.avaliacao'])->group(function () {
        Route::get('/home', [App\Http\Controllers\ExameController::class, 'index'])->name('estudante.index');
        Route::get('/profile', [App\Http\Controllers\Estudantes\PerfilController::class, 'index']);
        Route::put('/profile/{id}', [App\Http\Controllers\Estudantes\PerfilController::class, 'update']);
        Route::get('/avaliacao/{id}', [App\Http\Controllers\ExameController::class, 'exame']);
        Route::post('/avaliacao/{avaliacao}', [App\Http\Controllers\ExameController::class, 'store']);
        Route::post('/avaliacao/{avaliacao}/finalizar', [App\Http\Controllers\ExameController::class, 'concluirExame']);
        Route::get('/avaliacao/{avaliacao}/resultado', [App\Http\Controllers\ExameController::class, 'showResultado'])->name('estudante.resultado');
        Route::post('/logout', [App\Http\Controllers\Estudantes\AuthStudent::class, 'logout']);
        
        Route::put('/profile/{student}/reset', [App\Http\Controllers\Estudantes\AuthStudent::class, 'update']);
        // Route::put('/estudante/profile/{id}/reset', function(Request $request){
        //     dd('');
        // });
        // Route::get('/confirm-password', function () {
        //     return view('authEstudante.passwords.confirm');
        // })->name('password.confirm');
        // Route::post('/confirm-password', function (Request $request) {
            
        //     if (!Hash::check($request->password, $request->user('avaliacao')->password)) {
        //         return back()->withErrors([
        //             'password' => ['The provided password does not match our records.']
        //         ]);
        //     }
        //     $request->session()->passwordConfirmed();

        //     return redirect()->intended();
        // })->middleware(['throttle:6,1']);
    });
});


//TESTE ESTUDANTE
// Route::middleware(['guest'])->group(function () {

//     Route::get('/estudante/register', function () {
//         return view('authEstudante.register');
//     });
//     Route::post('/estudante/registro', [App\Http\Controllers\Estudantes\AuthStudent::class, 'store']);
Route::get('/estudante/login', [App\Http\Controllers\Estudantes\AuthStudent::class, 'index'])->name('estudante.login')->middleware(['guest']);
Route::post('/estudante/login', [App\Http\Controllers\Estudantes\AuthStudent::class, 'doLogin'])->middleware(['guest']);
// });
