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
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aparelho_id')->constrained('aparelhos')->onDelete('cascade');
            $table->text('defeito');
            $table->date('entrada');
            $table->date('saida')->nullable();
            $table->enum('status', ['aguardando', 'em_andamento', 'aguardando_pecas', 'pronto', 'entregue', 'cancelado'])->default('aguardando');
            $table->text('descricao')->nullable();
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->decimal('valor_pecas', 10, 2)->default(0);
            $table->decimal('valor_maodeobra', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencoes');
    }
};
