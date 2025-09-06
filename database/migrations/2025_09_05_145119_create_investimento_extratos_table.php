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
        Schema::create('investimento_extrato', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('investimento_id')
                ->constrained('investimentos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('valor_bruto', '10', '2')
                ->default(0);
            $table->decimal('valor_liquido', '10', '2')
                ->default(0);
            $table->decimal('ganho_perda', '10', '2')
                ->default(0);
            $table->decimal('ir_iof', '10', '2')
                ->default(0);
            $table->enum('movimento', ['guardo','rendimento','resgato'])->default('guardo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimento_extrato');
    }
};
