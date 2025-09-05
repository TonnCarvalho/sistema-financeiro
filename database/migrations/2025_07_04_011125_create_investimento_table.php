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
        Schema::create('investimentos', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('conta_bancaria_id')
                ->constrained('contas_bancarias')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nome');
            $table->decimal('valor_bruto', 10, 2)
            ->default(0);
            $table->decimal('valor_liquido', 10, 2)
            ->default(0);
            $table->decimal('ganho_perda', 10, 2)
            ->default(0);
            $table->decimal('ir_iof', 10, 2)
            ->default(0);
            $table->string('tipo_investimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimento');
    }
};
