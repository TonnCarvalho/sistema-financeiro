<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\ContaBancaria;
use App\Models\Investimento;
use Illuminate\Database\Seeder;
use Database\Factories\BancoFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        BancoFactory::criarBancosSemRepeticao();
        ContaBancaria::factory(1)->create();
        Investimento::factory()->create();
    }
}
