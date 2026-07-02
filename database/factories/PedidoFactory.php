<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    public function definition(): array
    {
        $dataPedido = fake()->dateTimeBetween('-2 months', 'now');

        return [
            'fornecedor_id' => Fornecedor::factory(),
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['cotacao', 'pago', 'producao', 'enviado', 'alfandega', 'entregue']),
            'frete' => fake()->randomFloat(2, 20, 300),
            'taxas' => fake()->randomFloat(2, 0, 150),
            'data_pedido' => $dataPedido,
            'previsao_entrega' => fake()->dateTimeBetween($dataPedido, '+2 months'),
            'observacoes' => fake()->optional()->sentence(),
        ];
    }
}