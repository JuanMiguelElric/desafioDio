<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('avaliacoes', App\Http\Controllers\Avaliacao\AvaliacaoController::class)->only('index', 'create', 'update', 'store', 'show', 'edit', 'destroy'); //rotas verificadas
    Route::get('/avaliacoesJson', [App\Http\Controllers\Avaliacao\AvaliacaoController::class, 'indexJson']); // rota para trazer as avaliações da tabela

    Route::resource('usuarios', App\Http\Controllers\Usuarios\UsuariosController::class)->only('index', 'store', 'edit','update', 'destroy');
    Route::get('/usuariosJson', [App\Http\Controllers\Usuarios\UsuariosController::class, 'indexJson']);

    Route::resource('perguntas', App\Http\Controllers\PerguntaController::class)->only('index', 'store', 'create', 'update', 'edit', 'show', 'destroy')->missing(function () {
        return response()->json(
            [
                'errors' => [
                    'notFound' => 'pergunta não encontrada!'
                ]
            ],
            404
        );
    });
// Alternativas
    Route::get('/perguntasJson/{id}', [App\Http\Controllers\Alternativa\AlternativaController::class, 'createJsonPerguntas']);
    Route::get('/perguntaComAlternativa/{id}', [App\Http\Controllers\Alternativa\AlternativaController::class, 'indexPerguntaWithAlternativas']);
    Route::resource('alternativas', App\Http\Controllers\Alternativa\AlternativaController::class)->only('index', 'store', 'create', 'update', 'edit', 'destroy')->missing(function () {
        return response()->json(
            [
                'errors' => [
                    'notFound' => 'alternativa não encontrada!'
                ]
            ],
            404
        );
    });

//Estudantes
    Route::resource('estudantes', App\Http\Controllers\StudentController::class)->only('index', 'store', 'edit','update','destroy');
    Route::get('/estudantesJson', [App\Http\Controllers\StudentController::class, 'indexJson']);

    Route::resource('admin', App\Http\Controllers\Admin\AvaliacoesEstudantesController::class)->only('create', 'store', 'index');

    Route::get('/avaliacaoEstudante/{avaliacao}', [App\Http\Controllers\Avaliacao\AvaliacaoController::class, 'showEstudanteConcluidos']);
    
    Route::get('indexjsoncount', [StudentController::class,'estudantesCountJson']);
    //TESTE
    Route::resource('profile', App\Http\Controllers\PerfilController::class)->only('index', 'update');
    Route::put('profile/{user}/reset', [App\Http\Controllers\Auth\ChangePasswordController::class, 'handle']);

    //CALENDÁRIO
    Route::get('/calendario', [App\Http\Controllers\CalendarioController::class, 'index']);
});