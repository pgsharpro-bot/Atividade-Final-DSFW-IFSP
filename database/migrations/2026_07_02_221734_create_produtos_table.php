<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->cascadeOnDelete();
            $table->string('nome');
            $table->string('categoria')->nullable();
            $table->decimal('preco_unitario_cny', 10, 2);
            $table->decimal('peso_kg', 8, 2)->nullable();
            $table->string('link')->nullable();
            $table->string('imagem_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};