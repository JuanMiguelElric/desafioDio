<?php

namespace App\Http\Controllers\Estudantes;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordEstudanteRequest;
use App\Mail\ChangePassword;
use App\Mail\EstudanteCriado;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthStudent extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authEstudante.index');
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
        $credentials = $request->validate([
            'email'    => ['required', 'email', 'unique:students'],
            'name'     => ['required'],
            'password' => ['required', 'confirmed']
        ]);

        // dd($request->all());
        $student =  Student::create(array_merge($credentials, ['ativo' => 1]));
        $email = new EstudanteCriado(
            $student->email,
            $credentials['password'],
            '/estudante/login',
            $student->name
        );
        Mail::to($student->email)->send($email);
        return redirect('/estudante/registro');
    }

    public function doLogin(Request $request)
    {
        // dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        // dd($validator);
        if ($validator->fails()) {
            return redirect('/estudante/login')
                ->withErrors($validator)
                ->withInput();
        }
        // dd($validator->validated());
        // dd(Auth::guard('web2')->attempt($validator->validated()));
        try {
            if (Auth::guard('avaliacao')->attempt($validator->validated())) {
                $request->session()->regenerate();

                return redirect()->intended('/estudante/profile');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (\PDOException $e) {
            return back()->withErrors([
                'email' => 'Não é possível entrar no momento.',
            ])->onlyInput('email');
        }
    }
    public function logout(Request $request): RedirectResponse
    {
        // dd(Auth::guard('avaliacao')->user());
        Auth::guard('avaliacao')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/estudante/login');

        // return $request->wantsJson()
        //     ? new JsonResponse([], 204)
        //     : redirect('/');
    }

    public function update(UpdatePasswordEstudanteRequest $request, Student $student)
    {
        // dd($request->validated(), $student);
        $student->fill([
            'password' => Hash::make($request->validated('password'))
        ]);
        if(!$student->save()){
            return back()->withErrors('erro ao processar!');
        }
        // $when = now()->addSeconds(10);
        // Mail::to($student)->later($when, new ChangePassword($student));
        return back()->with('message', 'Senha alterada com sucesso!');
    }
}
