<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_ve_listagem_de_fornecedores(): void
    {
        $user = User::factory()->create();
        Fornecedor::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('fornecedores.index'));

        $response->assertOk();
        $response->assertViewIs('fornecedores.index');
    }

    public function test_usuario_nao_autenticado_e_redirecionado_para_login(): void
    {
        $response = $this->get(route('fornecedores.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_usuario_autenticado_pode_criar_fornecedor(): void
    {
        $user = User::factory()->create();

        $dados = [
            'nome' => 'Shenzhen Tech Co.',
            'cidade' => 'Shenzhen',
            'pais' => 'China',
            'contato' => 'Li Wei',
            'whatsapp_wechat' => '+86 138 0000 0000',
            'site' => 'https://exemplo.com',
            'observacoes' => 'Fornecedor de eletrônicos.',
        ];

        $response = $this->actingAs($user)->post(route('fornecedores.store'), $dados);

        $response->assertRedirect(route('fornecedores.index'));
        $this->assertDatabaseHas('fornecedores', ['nome' => 'Shenzhen Tech Co.']);
    }

    public function test_criacao_de_fornecedor_falha_sem_nome(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('fornecedores.store'), [
            'nome' => '',
            'pais' => 'China',
        ]);

        $response->assertSessionHasErrors('nome');
        $this->assertDatabaseCount('fornecedores', 0);
    }

    public function test_usuario_autenticado_pode_atualizar_fornecedor(): void
    {
        $user = User::factory()->create();
        $fornecedor = Fornecedor::factory()->create(['nome' => 'Nome Antigo']);

        $response = $this->actingAs($user)->put(route('fornecedores.update', $fornecedor), [
            'nome' => 'Nome Atualizado',
            'cidade' => $fornecedor->cidade,
            'pais' => $fornecedor->pais,
        ]);

        $response->assertRedirect(route('fornecedores.index'));
        $this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id, 'nome' => 'Nome Atualizado']);
    }

    public function test_usuario_autenticado_pode_excluir_fornecedor(): void
    {
        $user = User::factory()->create();
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->actingAs($user)->delete(route('fornecedores.destroy', $fornecedor));

        $response->assertRedirect(route('fornecedores.index'));
        $this->assertDatabaseMissing('fornecedores', ['id' => $fornecedor->id]);
    }
}