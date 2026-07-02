<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::all();

        Fornecedor::all()->each(function (Fornecedor $fornecedor) use ($usuarios) {
            $produtos = $fornecedor->produtos;

            if ($produtos->isEmpty()) {
                return;
            }

            Pedido::factory()
                ->count(rand(1, 2))
                ->create([
                    'fornecedor_id' => $fornecedor->id,
                    'user_id' => $usuarios->random()->id,
                ])
                ->each(function (Pedido $pedido) use ($produtos) {
                    $itens = $produtos->random(min(3, $produtos->count()));

                    foreach ($itens as $produto) {
                        PedidoItem::create([
                            'pedido_id' => $pedido->id,
                            'produto_id' => $produto->id,
                            'quantidade' => rand(1, 20),
                            'preco_unitario_cny' => $produto->preco_unitario_cny,
                        ]);
                    }
                });
        });
    }
}