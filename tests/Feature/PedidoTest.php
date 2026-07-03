<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_ve_listagem_de_pedidos(): void
    {
        $user = User::factory()->create();
        Pedido::factory()->count(2)->create();

        $response = $this->actingAs($user)->get(route('pedidos.index'));

        $response->assertOk();
        $response->assertViewIs('pedidos.index');
    }

    public function test_usuario_autenticado_pode_criar_pedido_com_itens(): void
    {
        $user = User::factory()->create();
        $fornecedor = Fornecedor::factory()->create();
        $produto = Produto::factory()->create(['fornecedor_id' => $fornecedor->id]);

        $dados = [
            'fornecedor_id' => $fornecedor->id,
            'status' => 'cotacao',
            'data_pedido' => now()->format('Y-m-d'),
            'previsao_entrega' => now()->addDays(30)->format('Y-m-d'),
            'frete' => 50,
            'taxas' => 10,
            'observacoes' => 'Pedido de teste.',
            'itens' => [
                ['produto_id' => $produto->id, 'quantidade' => 3, 'preco_unitario_cny' => 25.5],
            ],
        ];

        $response = $this->actingAs($user)->post(route('pedidos.store'), $dados);

        $response->assertRedirect(route('pedidos.index'));
        $this->assertDatabaseHas('pedidos', ['fornecedor_id' => $fornecedor->id]);
        $this->assertDatabaseHas('pedido_itens', [
            'produto_id' => $produto->id,
            'quantidade' => 3,
        ]);
    }

    public function test_criacao_de_pedido_falha_sem_itens(): void
    {
        $user = User::factory()->create();
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->actingAs($user)->post(route('pedidos.store'), [
            'fornecedor_id' => $fornecedor->id,
            'status' => 'cotacao',
            'data_pedido' => now()->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors('itens');
        $this->assertDatabaseCount('pedidos', 0);
    }

    public function test_usuario_autenticado_pode_excluir_pedido(): void
    {
        $user = User::factory()->create();
        $pedido = Pedido::factory()->create();

        $response = $this->actingAs($user)->delete(route('pedidos.destroy', $pedido));

        $response->assertRedirect(route('pedidos.index'));
        $this->assertDatabaseMissing('pedidos', ['id' => $pedido->id]);
    }
}