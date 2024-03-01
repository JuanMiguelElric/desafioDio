<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Pessoa;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas = Empresa::all();
        foreach($empresas as $empresa){
            Pessoa::factory()
            ->state(['empresa_id'=>$empresa->id])
            ->create();

        }
    }
}
