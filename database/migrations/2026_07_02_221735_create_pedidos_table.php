<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['cotacao', 'pago', 'producao', 'enviado', 'alfandega', 'entregue'])
                ->default('cotacao');
            $table->decimal('frete', 10, 2)->default(0);
            $table->decimal('taxas', 10, 2)->default(0);
            $table->date('data_pedido');
            $table->date('previsao_entrega')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};