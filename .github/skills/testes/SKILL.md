---
name: testes
description: "Apply this skill whenever writing or reviewing automated tests (Feature or Unit) in the ImportaChina project. Covers what must be tested for each CRUD (Fornecedores, Produtos, Pedidos) and authentication, using PHPUnit conventions with factories and the RefreshDatabase trait."
license: MIT
metadata:
  author: importa-china
---
# Skill de Testes — ImportaChina

## Escopo mínimo de testes (Feature tests)
Para cada CRUD (Fornecedores, Produtos, Pedidos), cobrir:
1. Usuário autenticado consegue listar o recurso (`GET /recurso` retorna 200 e contém dados esperados).
2. Usuário autenticado consegue criar um registro válido (`POST /recurso` cria no banco, redireciona).
3. Criação com dados inválidos retorna erros de validação (campo obrigatório vazio).
4. Usuário autenticado consegue editar um registro existente.
5. Usuário autenticado consegue excluir um registro.
6. Usuário **não autenticado** é redirecionado para o login ao tentar acessar qualquer rota do recurso.

Para autenticação:
- Login com credenciais válidas autentica o usuário.
- Login com credenciais inválidas mostra erro e não autentica.
- Logout invalida a sessão.

## Convenções
- Testes ficam em `tests/Feature/{Recurso}Test.php` e `tests/Feature/AuthTest.php`.
- Usar `RefreshDatabase` (ou `LazilyRefreshDatabase`) em toda classe de teste que toca o banco.
- Sempre usar Factories (`Fornecedor::factory()->create()`) para gerar dados de teste, nunca inserir arrays manuais direto no banco.
- Nomear métodos de teste de forma descritiva: `public function test_operador_consegue_criar_fornecedor(): void`.
- Um `assert` de intenção clara por teste (ex: `assertDatabaseHas`, `assertRedirect`, `assertSessionHasErrors`), evitando testes genéricos demais.

## Rodando os testes
```
php artisan test
```
