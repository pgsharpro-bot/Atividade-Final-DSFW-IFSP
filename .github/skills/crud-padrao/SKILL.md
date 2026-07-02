---
name: crud-padrao
description: "Apply this skill whenever creating or modifying any CRUD (Fornecedores, Produtos, Pedidos) in the ImportaChina project. Covers controller structure, Form Requests, routes, validation, pagination, flash messages, and view organization. Use for every create/read/update/delete feature."
license: MIT
metadata:
  author: importa-china
---
# Skill de CRUD Padrão — ImportaChina

Garante que todos os CRUDs do sistema (Fornecedores, Produtos, Pedidos) sigam
exatamente a mesma estrutura.

## Estrutura de páginas
Cada recurso `X` tem sempre 4 views em `resources/views/x/`:
- `index.blade.php` — listagem paginada
- `create.blade.php` — formulário de criação (usa `_form.blade.php`)
- `edit.blade.php` — formulário de edição (usa `_form.blade.php`)
- `show.blade.php` — detalhe (quando o recurso tiver dados relacionados, ex: Pedido com itens)
- `_form.blade.php` — partial compartilhado entre create/edit

## Rotas
Sempre `Route::resource('recurso', RecursoController::class)` dentro do grupo
autenticado (`middleware(['auth'])`), nunca rotas soltas manuais para CRUD básico.

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('fornecedores', FornecedorController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('pedidos', PedidoController::class);
});
```

## Controllers
- Um controller por recurso, métodos padrão do resource (`index, create, store, edit, update, destroy` [, `show`]).
- Nunca validar inline no controller — sempre via Form Request (`php artisan make:request StoreFornecedorRequest`).
- Sempre usar `$request->validated()`, nunca `$request->all()`.
- `store`/`update` sempre redirecionam com flash message: `return redirect()->route('recurso.index')->with('success', 'Mensagem');`
- `index` sempre pagina: `Recurso::latest()->paginate(10)`.
- `destroy` sempre confirma no front (modal/`confirm()` JS) antes de enviar o DELETE.

## Form Requests
- Uma Request para Store e outra para Update (ou uma só reaproveitada) por recurso.
- Regras de validação centralizadas ali, nunca duplicadas em controller ou view.
- Mensagens de erro em português (`'nome.required' => 'O nome é obrigatório.'`).

## Paginação e mensagens
- Todas as listagens usam `->paginate(10)` e renderizam `{{ $itens->links() }}`.
- Mensagens de sucesso via `session('success')` exibidas no layout (`layouts/app.blade.php`), mensagens de erro de validação via `@error` em cada campo.

## Boas práticas obrigatórias
1. Autorização: toda ação de update/destroy verifica se o usuário tem permissão (via Policy ou checagem de role no controller).
2. Relacionamentos sempre carregados com `with()` para evitar N+1 (ex: `Produto::with('fornecedor')->paginate(10)`).
3. `$fillable` definido explicitamente em todo Model.
4. Nomes de rotas, views e variáveis sempre em português, minúsculo, seguindo o nome do recurso (consistência entre os 3 CRUDs).
