<?php

namespace Database\Seeders;

use App\Models\{Ativo,Area, Departamento, Empresa, Processo, Terceiro};
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::factory(10)
            ->has(Terceiro::factory(2))
            ->has(
                Area::factory(10)
                    ->has(
                        Departamento::factory(3)
                    )
            )
            ->create();
    }
}
