<?php

namespace Database\Seeders;

use App\Models\Alternativa;
use App\Models\Avaliacao;
use App\Models\Pergunta;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avaliacao::factory(5)->has(
            Pergunta::factory()->has(
                Alternativa::factory()
                    ->state(new Sequence(
                        ['verdadeiro' => true],
                        ['verdadeiro' => false],
                        ['verdadeiro' => false],
                        ['verdadeiro' => false],
                    ))
                    ->count(4)
            )->count(5)
        )->create();
    }
}
