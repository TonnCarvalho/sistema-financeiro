<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investimento_extrato_diario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investimento_id')
                ->constrained('investimentos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('investimento_extrato_id')
                ->constrained('investimento_extrato')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->decimal('valor_bruto_diario', '10', '2')
                ->default(0);
            $table->decimal('valor_liquido_diario', '10', '2')
                ->default(0);
            $table->decimal('ganho_perda_diario', '10', '2')
                ->default(0);
            $table->decimal('ir_iof_diario', '10', '2')
                ->default(0);
            $table->enum('movimento', ['entrada', 'rendimento', 'saida'])->default('entrada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimento_extrato_diario');
    }
};
