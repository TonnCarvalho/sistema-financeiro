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
            'valor_aplicado' => 20176.92,
            'valor_bruto' => 20498.27,
            'valor_liquido' => 20176.92,
            'ganho_perda' => 0,
            'ir_iof' => 321.35,
            'tipo_investimento' => 'cdb'
        ];
    }
}
