# Relatório do Projeto — ImportaChina

## 1. Contexto e Planejamento

### Tema
Sistema de gestão para **importação de produtos da China**, cobrindo o
fluxo de fornecedores → catálogo de produtos → pedidos de importação.

### Descrição da aplicação
O ImportaChina centraliza o controle de fornecedores chineses, o
catálogo de produtos oferecidos por cada um deles e os pedidos de
importação realizados, com acompanhamento de status (cotação, pago,
produção, enviado, alfândega, entregue) e cálculo automático de custos
(subtotal por item, frete, taxas e total geral em CNY).

### Plano de Implementação
O planejamento completo (contexto, escopo, entidades, telas, ordem de
implementação, tecnologias, riscos e critérios de aceite) está
documentado em [`PLANO_IMPLEMENTACAO.md`](./PLANO_IMPLEMENTACAO.md),
elaborado antes do início da geração de código com IA.

## 2. Ferramentas de IA

### MCP utilizado
**Laravel Boost MCP** (`php artisan boost:mcp`), configurado em
`.vscode/mcp.json` e habilitado via `boost.json`.

- **Função no ecossistema:** o MCP do Laravel Boost expõe ferramentas
  que dão à IA acesso ao contexto real da aplicação — versões dos
  pacotes instalados, estrutura de rotas (`list-routes`), schema do
  banco de dados (`database-schema`), execução de tinker
  (`tinker`), leitura de logs da aplicação (`browser-logs`,
  `read-log-entries`) e busca na documentação oficial do Laravel
  (`search-docs`) filtrada pela versão exata instalada no projeto.
- **Finalidade no projeto:** evitar que a IA "alucinasse" código
  incompatível com a versão do Laravel instalada (11.x) ou com o
  schema real das tabelas. Antes de gerar os Form Requests e
  Controllers de Produtos e Pedidos, o MCP foi usado para consultar o
  schema das tabelas `produtos`, `pedidos` e `pedido_itens` e
  confirmar nomes exatos de colunas e relacionamentos antes de
  escrever a validação.
- **Exemplos de utilização:**
  - Consulta ao schema do banco para conferir os campos de `pedido_itens`
    (`pedido_id`, `produto_id`, `quantidade`, `preco_unitario_cny`)
    antes de montar a `StorePedidoRequest`.
  - Consulta a `list-routes` para validar que as rotas `resource` de
    `produtos` e `pedidos` foram registradas corretamente após cada
    alteração em `routes/web.php`.
  - Uso do `search-docs` para confirmar a sintaxe atual de
    `Route::resource()->parameters()` na versão do Laravel instalada.

### Skills desenvolvidas
Armazenadas em `.github/skills/`, conforme padrão do Laravel Boost:

**Obrigatórias:**
- **`identidade-visual`** — define a paleta de cores (vermelho `red-700`
  como cor de marca, remetendo à bandeira chinesa), tipografia,
  espaçamento e padronização visual de todas as telas (sidebar,
  cabeçalho, cards, tabelas, formulários), garantindo que
  Fornecedores, Produtos e Pedidos tenham a mesma aparência.
- **`crud-padrao`** — define a estrutura fixa que todo CRUD do sistema
  deve seguir: 4 views por recurso (`index`, `create`, `edit`, `show`
  + parcial `_form`), Form Requests separadas para Store/Update,
  paginação de 10 itens, mensagens de erro em português e flash
  message de sucesso após cada ação.

**Opcionais (2 ou mais):**
- **`seguranca`** — regras de hashing de senha, proteção contra mass
  assignment (uso de `$fillable`), autorização por perfil (`role`) e
  CSRF em todos os formulários.
- **`testes`** — escopo mínimo de testes Feature para cada CRUD
  (listagem, criação válida/inválida, edição, exclusão), usando
  factories e `RefreshDatabase`.

Além dessas, o próprio Laravel Boost instalou a skill
`laravel-best-practices`, com regras gerais de arquitetura, Eloquent,
validação, migrations e estilo de código do Laravel, usada como base
para todo o desenvolvimento.

## 3. Desenvolvimento

### Funcionalidades implementadas
- Autenticação completa via Laravel Breeze (login, registro,
  recuperação de senha, verificação de e-mail)
- Dois perfis de usuário (`admin`, `operador`) com middleware
  `EnsureIsAdmin`
- CRUD completo de **Fornecedores**
- CRUD completo de **Produtos**, vinculados a um fornecedor
- CRUD completo de **Pedidos**, com itens dinâmicos (adicionar/remover
  produtos via JavaScript no formulário), preço unitário
  auto-preenchido a partir do cadastro do produto (editável) e cálculo
  em tempo real de subtotal por item e total do pedido
- Seeders com usuários de teste e dados de exemplo (fornecedores,
  produtos e pedidos fictícios)

### Decisões de projeto
- **Preço unitário duplicado em `produtos` e `pedido_itens`:** o preço
  do produto é copiado para o item do pedido no momento da criação,
  em vez de sempre referenciar `produtos.preco_unitario_cny`. Isso
  preserva o histórico real de quanto foi pago em cada pedido, mesmo
  que o preço do produto mude depois.
- **Itens do pedido em JavaScript puro (sem Livewire/Alpine
  avançado):** optou-se por um script simples que clona um
  `<template>` HTML e reindexa os `name`s dos campos
  (`itens[N][campo]`) a cada alteração, evitando adicionar uma
  dependência nova ao projeto só para essa tela.
- **Update de itens por "apagar e recriar":** ao editar um pedido, os
  itens antigos são removidos e os novos são inseridos dentro de uma
  transaction (`DB::transaction`), em vez de fazer diff item a item.
  Mais simples de implementar e manter, com o custo aceitável de
  recriar os IDs dos itens a cada edição.

### Dificuldades encontradas
- Reindexação dos campos de itens do pedido em JavaScript ao
  adicionar/remover linhas dinamicamente, para que o Laravel recebesse
  o array `itens` sempre com índices sequenciais e sem "buracos".
- Repopular o formulário de edição de pedido com os itens já
  cadastrados, combinando os dados vindos do banco com o `old()` do
  Laravel (caso a validação falhe e o formulário precise ser
  reexibido com os dados que o usuário havia digitado).

## 4. Conclusão

### Limitações da aplicação
- Não há upload de imagem de produto (usa-se apenas uma URL externa).
- O cálculo de frete/taxas é manual (inserido pelo operador), sem
  integração com serviços de frete internacional.
- Não há edição de perfil de acesso pela interface (o campo `role` é
  definido apenas via seeder/banco).

### Utilização da IA durante o desenvolvimento
A IA (Claude, via Vibe Coding) foi utilizada para gerar a primeira
versão de todos os Controllers, Form Requests, Migrations, Models,
Seeders e Views do sistema, sempre a partir de um Plano de
Implementação definido previamente. Todo o código gerado foi revisado,
testado manualmente na aplicação rodando localmente (XAMPP + MySQL) e
commitado de forma incremental, validando cada CRUD antes de avançar
para o próximo.

### Conclusão geral
O projeto atingiu os requisitos mínimos propostos: autenticação
funcional, banco de dados com migrations e seeders, múltiplos CRUDs
completos e consistentes visualmente, uso documentado de MCP e Plano
de Implementação no repositório. O desenvolvimento assistido por IA
acelerou a criação do código repetitivo (CRUDs seguindo o mesmo
padrão), enquanto as Skills garantiram consistência entre as telas sem
que fosse necessário repetir instruções de estilo a cada novo recurso.