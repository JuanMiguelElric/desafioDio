<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Task\StoreTaskRequest;
use App\Http\Requests\Dashboard\Task\UpdateTaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $tasks = $user->tasks()
            ->orderBy('id', 'desc')
            ->paginate(5);
        $paginationHtml = $tasks->links()->toHtml();
        return response()->json(compact('tasks', 'paginationHtml'), 200);
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
    public function store(StoreTaskRequest $request)
    {
        try {
            /**
             * @var User $user
             */
            $user = Auth::user();
            $obTask = new Task(array_merge($request->validated(), ['completed' => false]));
            if ($user->tasks()->save($obTask)) {
                return response()->json(['type' => 'success', 'message' => 'Tarefa criada com sucesso!']);
            }
            throw new Exception('erro ao processar tarefa!', 404);
        } catch (Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'Oops, erro ao gerar tarefa, tente novamente!'], 404);
        }
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
    public function edit(Task $task)
    {
        return response()->json(compact('task'), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = [];
        foreach ($request->validated() as $key => $value) {
            $novaChave = str_replace('edit_', "", $key);
            // dd('key: '.$key, 'valor: '.$value,'Nova Chave: '. $novaChave);
            $data[$novaChave] = $value;
        }
        $task->fill($data);
        // dd($task);
        if ($request->json == 1) {

            if ($task->save()) {
                // return to_route('empresas.tasks.index', $task->empresa->id);
                return response()->json(['type' => 'success', 'message' => 'tarefa atualizado!']);
            }
            return response()->json(['type' => 'error', 'message' => 'Erro ao processar!'], 400);
        }
    }

    public function updateCompleted(Task $task)
    {
        if($task->completed == true){
            $task->update(['completed'=> false]);
            return response()->json(['type'=> 'success', 'message'=> 'tarefa desmarcada com sucesso!']);
        }
        $task->update(['completed'=> true]);
        return response()->json(['type'=> 'success', 'message'=> 'tarefa concluída com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::destroy($id);
        return response()->json(['message' => 'Tarefa excluída com sucesso!', 'type' => 'success']);
    }
}
