<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departamento>
 */
class DepartamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'        => "Departamento ".fake('pt_BR')->name(),
            'responsavel' => fake('pt_BR')->name(),
            'telefone'    => fake('pt_BR')->cellPhoneNumber(),
            'email'       => fake('pt_BR')->email(),
            'status'      => true
        ];
    }
}
