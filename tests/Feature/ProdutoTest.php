<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_ve_listagem_de_produtos(): void
    {
        $user = User::factory()->create();
        Produto::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('produtos.index'));

        $response->assertOk();
        $response->assertViewIs('produtos.index');
    }

    public function test_usuario_autenticado_pode_criar_produto(): void
    {
        $user = User::factory()->create();
        $fornecedor = Fornecedor::factory()->create();

        $dados = [
            'fornecedor_id' => $fornecedor->id,
            'nome' => 'Fone Bluetooth XT-10',
            'categoria' => 'Eletrônicos',
            'preco_unitario_cny' => 49.90,
            'peso_kg' => 0.2,
            'link' => 'https://exemplo.com/produto',
            'imagem_url' => null,
        ];

        $response = $this->actingAs($user)->post(route('produtos.store'), $dados);

        $response->assertRedirect(route('produtos.index'));
        $this->assertDatabaseHas('produtos', ['nome' => 'Fone Bluetooth XT-10']);
    }

    public function test_criacao_de_produto_falha_sem_fornecedor(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('produtos.store'), [
            'nome' => 'Produto Sem Fornecedor',
            'preco_unitario_cny' => 10,
        ]);

        $response->assertSessionHasErrors('fornecedor_id');
        $this->assertDatabaseCount('produtos', 0);
    }

    public function test_usuario_autenticado_pode_atualizar_produto(): void
    {
        $user = User::factory()->create();
        $produto = Produto::factory()->create(['nome' => 'Produto Antigo']);

        $response = $this->actingAs($user)->put(route('produtos.update', $produto), [
            'fornecedor_id' => $produto->fornecedor_id,
            'nome' => 'Produto Atualizado',
            'preco_unitario_cny' => $produto->preco_unitario_cny,
        ]);

        $response->assertRedirect(route('produtos.index'));
        $this->assertDatabaseHas('produtos', ['id' => $produto->id, 'nome' => 'Produto Atualizado']);
    }

    public function test_usuario_autenticado_pode_excluir_produto(): void
    {
        $user = User::factory()->create();
        $produto = Produto::factory()->create();

        $response = $this->actingAs($user)->delete(route('produtos.destroy', $produto));

        $response->assertRedirect(route('produtos.index'));
        $this->assertDatabaseMissing('produtos', ['id' => $produto->id]);
    }
}