---
name: seguranca
description: "Apply this skill whenever writing authentication, authorization, form handling, or file upload code in the ImportaChina project. Covers password hashing, CSRF, mass assignment protection, role-based access, and input sanitization. Use for login, middleware, policies, and any user-facing form."
license: MIT
metadata:
  author: importa-china
---
# Skill de Segurança — ImportaChina

## Autenticação
- Senhas sempre via `Hash::make()` / cast `hashed` no Model `User`, nunca texto puro.
- Sessões usam os drivers padrão do Laravel (`session` driver `database` ou `file`), sem tokens customizados.
- Rate limit no login: usar o throttle padrão do Laravel Breeze (`throttle:login`) para evitar força bruta.

## Autorização por perfil (role)
- Coluna `role` em `users` (`admin` | `operador`).
- Middleware customizado (`EnsureIsAdmin`) protege rotas restritas a admin (ex: exclusão de fornecedores).
- Nunca checar `role` direto na Blade sem também checar no controller/middleware — a view só esconde, não protege.

## Proteção de dados
- `$fillable` obrigatório em todo Model (nunca `$guarded = []`).
- Todo formulário POST/PUT/DELETE tem `@csrf`.
- Nenhuma query com SQL cru concatenando input do usuário — sempre Eloquent/Query Builder com bindings.
- Uploads de imagem (ex: imagem de produto): validar `mimes:jpg,jpeg,png|max:2048` e nunca confiar no nome original do arquivo (gerar nome via `Str::uuid()`).

## Boas práticas gerais
1. `.env` nunca commitado (já vem no `.gitignore` padrão do Laravel — não remover).
2. Variáveis sensíveis sempre lidas via `config()`, nunca `env()` fora dos arquivos de config.
3. Saída de dados do usuário em Blade sempre com `{{ }}` (escapa HTML), nunca `{!! !!}` para conteúdo vindo de formulário.
4. Logout sempre invalida a sessão e regenera o token CSRF.
