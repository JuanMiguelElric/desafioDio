<?php

namespace App\Services\Empresa;

use App\Models\Empresa;
use App\Models\Filial;
use Exception;
use Illuminate\Support\Facades\DB;

class EmpresaService
{
    public function __construct(
        private Empresa $empresa
    ) {
    }

    public function add(array $data): bool|Exception
    {
        if (isset($data['filial'])) {
            DB::transaction(function () use ($data) {
                $obEmpresa = Empresa::create(
                    [
                        'nome'       => $data['nome'],
                        'cnpj'       => $data['cnpj'],
                        'telefone'   => $data['telefone'],
                        'email'      => $data['email'],
                        'observacao' => $data['observacao'],
                        'created_by' => $data['created_by']
                    ]
                );
                foreach ($data['filial'] as $filial) {
                    $obEmpresa->filiais()->save(new Filial($filial));
                }
            });
            return true;
        }
        $obEmpresa = new Empresa(
            $data
        );
        if ($obEmpresa->save()) {
            return true;
        }

        throw new Exception("Oops, algo deu errado! Por favor verifique os dados!", 422);

        // return response()->json([
        //     'type' => 'error',
        //     "errors" => [
        //         'message' => 'Oops, algo deu errado! Por favor verifique os dados!'
        //     ]
        // ], 422);
        // return true;
    }
}
