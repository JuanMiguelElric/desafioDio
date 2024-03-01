<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avaliacao>
 */
class AvaliacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'             => fake('pt_BR')->unique()->name(),
            'descricao'          => fake('pt_BR')->text(50),
            'cliente'            => fake('pt_BR')->name(),
            'created_by_user_id' => 1
        ];
    }
}
