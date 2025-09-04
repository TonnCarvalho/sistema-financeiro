<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Banco;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bancos>
 */
class BancoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => '',
            'image' => ''
        ];
    }

    /**
     * Retorna o array com os dados dos bancos
     */
    public static function getDadosBancos(): array
    {
        return [
            [
                'nome' => 'Banco Inter',
                'image' => 'https://altarendablog.com.br/wp-content/uploads/2023/12/3afb1b054f7646acabdcd1e953f77c7d_thumb1.jpg'
            ],
            [
                'nome' => 'Nu Bank',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4fPuS-NYviQ6H_zT2egJxhh0ESTKZURSUow&s'
            ],
            [
                'nome' => 'Banco Itau',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/19/Ita%C3%BA_Unibanco_logo_2023.svg'
            ]
        ];
    }
    /**
     * Criar os bancos sem repetição usando os dados pré-definidos
     * Método retornado em DatabaseSeeder.php
     */
    public static function criarBancosSemRepeticao(): void
    {
        //método com os dados do banco
        $bancos = self::getDadosBancos();

        //cria os dados em sequencia
        Banco::factory()
            ->count(count($bancos))
            ->sequence(...$bancos)
            ->create();
    }
}
