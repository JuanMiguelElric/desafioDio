<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('pt_BR');
        return [
            "nome" => $fake->name(),
            "cnpj" => $fake->cnpj(),
            "telefone" => $fake->cellphoneNumber(),
            "email" => $fake->safeEmail(),
            "observacao" => $fake->text(),
            "created_by" => 1,
            "status" => true
        ];
    }
}
