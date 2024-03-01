<?php

namespace App\Http\Controllers\DataMapping;

use App\Http\Controllers\Controller;
use App\Models\Filial;
use Illuminate\Http\Request;

class FilialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request, string $id)
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Filial::destroy($id) > 0){
            return response()->json(['type'=>'success', 'message'=> 'Filial excluída com sucesso!']);
        }
        return response()->json(['type'=>'error', 'message'=> 'algo deu errado!']);
    }
}
