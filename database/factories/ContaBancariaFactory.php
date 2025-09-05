<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContaBancaria>
 */
class ContaBancariaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'banco_id' => 1,
            'nome' => 'Banco Inter',
            'saldo' => 1000,
            'status' => 'ativo',
            'mostra_saldo' => 1
        ];
    }
}
