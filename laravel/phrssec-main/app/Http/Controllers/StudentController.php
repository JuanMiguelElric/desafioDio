<?php

namespace App\Http\Controllers;

use App\Events\RegisteredStudent;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateEstudanteRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(private StudentService $studentService)
    {
        # code...
    }
    public function index()
    {

        return view('estudantes.index');
    }

    public function indexJson()
    {

        $studentData = [];
        foreach (Student::lazy() as $student) {

            $btnEdit    = '<a href="' . route('estudantes.edit', $student->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class = "fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete  = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="' . $student->id . '">
            <i class = "fa fa-lg fa-fw fa-trash"></i>
            </button>';
            // $btnDetails = '<a href="' . route('estudantes.show', $student->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            // <i class="fa fa-lg fa-fw fa-eye"></i>
            // </a>';

            $studentData[] = [
                "id"    => $student->id,
                "name"  => $student->name,
                "email" => $student->email,
                "btns"  => '<nobr>' . $btnEdit . $btnDelete . /*$btnDetails .*/ '</nobr>',
            ];
        }
        // dd(\DB::getQueryLog());
        return response()->json(['estudantes' => $studentData]);
    }

    // INSERIR ESTUDANTE E DEPOIS ENVIAR EMAIL
    public function store(StoreStudentRequest $request)
    {
        if ($request->safe()->only(['json']) === '0') {
            return response()->json(['data' => 'implementar web']);
        }
        $student = $this->studentService->add($request->validated());
        if ($student instanceof Student) {
            event(new RegisteredStudent($student->email, $request->validated('password'), $student->name));
            return response()->json(['message' => 'Estudante cadastrado com sucesso!', "code" => "201"], 201);
        }

        return response()->json([
            'errors' => [
                'message' => 'Erro ao cadastrar estudante!',
            ]
        ], 422);

        // $student->notify(new CustomEmailVerifyEstudante($student));
        // event(new Registered($student));
    }

    public function edit(Student $estudante): View
    {
        return view('estudantes.edit', compact('estudante'));
    }

    public function update(UpdateEstudanteRequest $request, Student $estudante)
    {

        $validatedData = array_filter($request->validated(), function ($value) {
            return !is_null($value);
        });
        $estudante->fill($validatedData);
        if ($estudante->save()) {
            return response()->json(['message' => 'estudante atualizado com sucesso!'], 200);
        }
        return response()->json(['message' => 'não foi possível atualizar o estudante!'], 422);
    }

    public function destroy(string $id)
    {
        $removido = Student::destroy($id);

        if ($removido != 0) {
            return response()->json(['message' => 'Estudante apagado com sucesso']);
        }
    }

    public function estudantesCountJson()
    {
        $estudantes = Student::count();
        return response()->json(
            ['estudantes' => $estudantes],
            200
        );
    }
}
