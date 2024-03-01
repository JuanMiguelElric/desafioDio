<?php

use App\Http\Controllers\Cargo\CargoController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\DataMapping\Area\AreaController;
use App\Http\Controllers\DataMapping\Departamento\DepartamentoController;
use App\Http\Controllers\DataMapping\Empresa\EmpresaController;
use App\Http\Controllers\DataMapping\pessoa\PessoaController;
use App\Http\Controllers\DataMapping\FilialController;
use App\Http\Controllers\DataMapping\Terceiro\TerceiroController;
use App\Models\Cargo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//rotas nao permitidas
// Auth::routes();
 //Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']);

//Routes de segurança do administrador
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->middleware(['auth']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
Route::get('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm']);  
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']); 
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->middleware('guest');

//USUARIO ADM

include 'admin.php';


//ROTA PARA ALUNOS

include 'estudantes.php';

Route::middleware(['auth'])->group(function () {
    //DASHBOARD
    Route::resource('dashboard', DashboardController::class);
    //TODO-LIST
    Route::resource('tasks', TaskController::class);
    Route::get('/tasks-json', [TaskController::class, 'index'])->name('tasks.json');
    Route::put('/tasks-json-update/{task}', [TaskController::class, 'updateCompleted'])->name('tasks.update.complete');
    //FIM-TODO-LIST

    //FIM-DASHBOARD  

    //DataMapping
    
    //empresas
    Route::resource('empresas', EmpresaController::class)->only(['index', 'store', 'edit', 'show', 'update', 'destroy'])->missing(function(){
        return to_route('empresas.index');
    });
    Route::get('/empresasJson', [EmpresaController::class, 'empresasJson']);
    Route::get('/buscaporid/{id}', [EmpresaController::class, 'buscaPorId']);
    //fim empresas
    
    //pessoa
    Route::resource('empresas.pessoa',PessoaController::class)->shallow();
    Route::get('/empresas/{empresa}/pessoas', [PessoaController::class,'indexJson'])->name('empresas.pessoa.json');
    Route::get('/empresas/pessoas/index/{empresa}',[PessoaController::class,'index'])->name('empresas.pessoa.index');
    Route::get('/Pessoajson/{pessoa}', [PessoaController::class, 'editJson'])->name('pessoa.json');
    Route::get('/empresas/{empresa}/pessoas/{limit}',[PessoaController::class,'indexPaginaPessoa'])->name('empresas.pessoa.paginado');

    
    //fim pessoa
    //cargo
    Route::resource('empresas.cargo',CargoController::class)->shallow();
    Route::get('empresas/{empresa}/cargojson',[CargoController::class,'indexJson'])->name('empresas.cargo.json');
    Route::get('/empresas/cargo/index/{empresa}',[CargoController::class,'index'])->name('empresas.cargo.index');
    Route::get('/CargoJson/{cargo}', [CargoController::class, 'editJson'])->name('cargo.json');
    Route::get('/empresas/{empresa}/cargos/{limit}',[CargoController::class,'indexPaginaCargo'])->name('empresas.cargo.paginado');


    //fim cargo 
    //Terceiros
    Route::resource('empresas.terceiros', TerceiroController::class)->shallow();
    Route::get('/empresas/{empresa}/terceirosjson', [TerceiroController::class, 'indexJson'])->name('empresas.terceiros.json');
    Route::get('/terceirojson/{terceiro}', [TerceiroController::class, 'editJson'])->name('terceiro.json');
    Route::get('/empresas/{empresa}/terceiros/{limit}',[TerceiroController::class, 'indexPaginateTerceiros'])->name('empresas.terceiros.paginado');
    //fim Terceiros
    
    //filiais
    Route::resource('empresas.filiais', FilialController::class)->shallow();
    //fim filiais
    Route::resource('areas', AreaController::class)->only(['index', 'store', 'edit', 'show', 'update', 'destroy'])->missing(function () {
        return response()->json([
            'type'   => 'error',
            'errors' => [
                'message' => 'Area não encontrada!'
            ]
        ], 404);
    });
   

    Route::get('/areabuscaporid/{id}', [AreaController::class, 'buscaPorId']);

    Route::resource('departamentos', DepartamentoController::class)->only(['index', 'store', 'edit', 'show', 'update', 'destroy']);
    Route::get('/areadepartamentobuscaporid/{area}', [DepartamentoController::class, 'areaDepartamentoBuscaPorId']);
    
    //Fim DataMapping

});


Route::middleware(['guest'])->group(function () {

    Route::get('/termos-e-usos', function () {
        return view('phrssec.termos-de-aviso');
    });

    Route::get('/politica-de-privacidade', function () {
        return view('phrssec.politica-de-privacidade');
    });

    Route::get('/', function () {
        return view('phrssec.index');
    })->name('index');
});


Route::any('{any}', function () {
    return redirect('/');
})->where('any', '.*');
