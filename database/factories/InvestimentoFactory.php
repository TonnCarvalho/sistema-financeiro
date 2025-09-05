<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investimento>
 */
class InvestimentoFactory extends Factory
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
            'conta_bancaria_id' => 1,
            'nome' => 'Carro',
            'valor_bruto' => 1000,
            'valor_liquido' => 900,
            'ganhos_perdas' => 190,
            'ir_iof' => 10,
            'tipo_investimento' => 'cdb'
        ];
    }
}
