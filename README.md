# ImportaChina 🇨🇳📦

Sistema de gestão para importação de produtos da China. Permite
cadastrar fornecedores, catalogar produtos e controlar pedidos de
importação (cotação → pago → produção → enviado → alfândega →
entregue), com cálculo automático de custos (produto + frete + taxas).

Projeto desenvolvido para a disciplina de Desenvolvimento de Aplicações
com Laravel + Laravel Boost + Vibe Coding.

## Tecnologias utilizadas

- [Laravel 11](https://laravel.com) + [Laravel Boost](https://github.com/laravel/boost)
- Laravel Breeze (autenticação)
- MySQL
- Tailwind CSS
- Blade Components
- Vite

## Requisitos

- PHP >= 8.2
- Composer
- MySQL (via XAMPP ou similar)
- Node.js + NPM

## Instalação

1. Clone o repositório e entre na pasta do projeto:
```bash
   git clone <url-do-repositorio>
   cd importa-china
```

2. Instale as dependências PHP e JS:
```bash
   composer install
   npm install
```

3. Copie o arquivo de ambiente e gere a chave da aplicação:
```bash
   cp .env.example .env
   php artisan key:generate
```

4. No `.env`, configure a conexão com o MySQL (crie o banco
   `importa_china` antes, pelo phpMyAdmin ou linha de comando):
```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=importa_china
   DB_USERNAME=root
   DB_PASSWORD=
```

5. Rode as migrations e os seeders (cria as tabelas e os dados de
   teste, incluindo os usuários):
```bash
   php artisan migrate --seed
```

6. Compile os assets front-end:
```bash
   npm run build
```
   Ou, durante o desenvolvimento, em outro terminal:
```bash
   npm run dev
```

7. Suba o servidor da aplicação:
```bash
   php artisan serve
```

8. Acesse: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Usuários de teste

Criados automaticamente pelo seeder (`database/seeders/DatabaseSeeder.php`):

| E-mail                     | Senha      | Perfil    |
|-----------------------------|------------|-----------|
| admin@importachina.com      | password   | admin     |
| operador@importachina.com   | password   | operador  |

## Funcionalidades

- Autenticação (login, registro, recuperação de senha)
- CRUD de Fornecedores
- CRUD de Produtos (vinculados a um fornecedor)
- CRUD de Pedidos, com múltiplos itens, cálculo automático de subtotal
  por item e total geral (produtos + frete + taxas)
- Dashboard inicial

## Documentação do projeto

- [`PLANO_IMPLEMENTACAO.md`](./PLANO_IMPLEMENTACAO.md) — plano elaborado
  antes do desenvolvimento
- [`RELATORIO.md`](./RELATORIO.md) — relatório completo do
  desenvolvimento, uso de IA e MCP

## Rodando os testes

```bash
php artisan test
```