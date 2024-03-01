<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Terceiro>
 */
class TerceiroFactory extends Factory
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
            "nome_terceiro" => $fake->name(),
            "site_terceiro" => $fake->url(),
            "cnpj_terceiro" => $fake->cnpj(),
            "nome_do_representante" => $fake->name(),
            "email_do_representante" => $fake->email(),
            "telefone_do_representante" => $fake->cellphoneNumber(),
        ];
    }
}
