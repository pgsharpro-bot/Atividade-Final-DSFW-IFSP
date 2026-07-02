<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fornecedor_id' => Fornecedor::factory(),
            'nome' => fake()->randomElement([
                'Fone de Ouvido Bluetooth',
                'Smartwatch Esportivo',
                'Mini Câmera de Segurança',
                'Carregador Portátil 10000mAh',
                'Suporte de Celular para Carro',
                'Luminária LED USB',
                'Mouse Sem Fio',
                'Capinha de Silicone',
                'Cabo USB-C Reforçado',
                'Caixa de Som Portátil',
            ]).' - '.fake()->word(),
            'categoria' => fake()->randomElement(['Eletrônicos', 'Acessórios', 'Casa', 'Informática', 'Brindes']),
            'preco_unitario_cny' => fake()->randomFloat(2, 5, 200),
            'peso_kg' => fake()->randomFloat(2, 0.05, 3),
            'link' => fake()->url(),
            'imagem_url' => null,
        ];
    }
}