# Plano de Implementação — ImportaChina

## 1. Contexto

### Objetivo da aplicação
O ImportaChina é um sistema de gestão para pessoas ou pequenas empresas que
importam produtos da China para revenda. A aplicação centraliza o
cadastro de fornecedores, o catálogo de produtos disponíveis para compra
e o acompanhamento dos pedidos de importação, desde a cotação até a
entrega final.

### Problema que resolve
Importadores de pequeno porte costumam controlar fornecedores, produtos
e pedidos em planilhas soltas ou conversas de WhatsApp/WeChat, o que
dificulta o acompanhamento de status de pedidos (cotação, produção,
envio, alfândega, entrega), o cálculo de custos totais (produto + frete
+ taxas) e o histórico de compras por fornecedor. O sistema resolve isso
concentrando essas informações em um único lugar, com histórico e
cálculos automáticos.

### Público-alvo
Pequenos importadores e revendedores que compram produtos da China em
lotes (dropshipping, revenda em marketplace, lojas físicas) e precisam
de controle simples de fornecedores, catálogo e pedidos.

## 2. Escopo

### Funcionalidades
- Autenticação (login, registro, recuperação de senha) via Laravel Breeze
- Dois perfis de usuário: `admin` e `operador`
- CRUD completo de **Fornecedores**
- CRUD completo de **Produtos**, vinculados a um fornecedor
- CRUD completo de **Pedidos**, com múltiplos itens (produto + quantidade
  + preço unitário no momento da compra), cálculo automático de
  subtotal por item e total do pedido (produtos + frete + taxas)
- Dashboard inicial após login
- Paginação em todas as listagens

### Entidades do banco de dados
- **users** — usuários do sistema (`name`, `email`, `password`, `role`)
- **fornecedores** — `nome`, `cidade`, `pais`, `contato`,
  `whatsapp_wechat`, `site`, `observacoes`
- **produtos** — `fornecedor_id`, `nome`, `categoria`,
  `preco_unitario_cny`, `peso_kg`, `link`, `imagem_url`
- **pedidos** — `fornecedor_id`, `user_id`, `status` (enum: cotacao,
  pago, producao, enviado, alfandega, entregue), `frete`, `taxas`,
  `data_pedido`, `previsao_entrega`, `observacoes`
- **pedido_itens** — `pedido_id`, `produto_id`, `quantidade`,
  `preco_unitario_cny`

Relacionamentos: Fornecedor `1:N` Produto; Fornecedor `1:N` Pedido;
Pedido `1:N` PedidoItem; Produto `1:N` PedidoItem; User `1:N` Pedido.

### Telas
1. Login / Registro (Breeze)
2. Dashboard
3. Listagem, criação, edição e detalhes de Fornecedores
4. Listagem, criação, edição e detalhes de Produtos
5. Listagem, criação, edição e detalhes de Pedidos (com itens dinâmicos)
6. Perfil do usuário (Breeze)

### Ordem de implementação
1. Configuração do projeto (Laravel + Boost + banco de dados)
2. Autenticação (Laravel Breeze)
3. Modelagem (migrations, models, relacionamentos)
4. Seeders e usuários de teste
5. Skills de padronização (identidade visual e CRUD)
6. Layout base (sidebar, navegação, componentes)
7. CRUD de Fornecedores
8. CRUD de Produtos
9. CRUD de Pedidos (com itens)
10. Documentação (README e Relatório)

## 3. Técnico

### Tecnologias utilizadas
- Laravel 11 + Laravel Boost
- Laravel Breeze (autenticação)
- MySQL (via XAMPP)
- Tailwind CSS
- Blade Components
- JavaScript nativo (para os itens dinâmicos do pedido)
- Git

### Riscos
- Cálculo incorreto de totais do pedido caso os valores de itens não
  sejam validados corretamente no backend — mitigado com Form Requests
  dedicadas (`StorePedidoRequest`/`UpdatePedidoRequest`) validando cada
  item do array.
- Perda de integridade referencial ao excluir fornecedor/produto com
  pedidos vinculados — mitigado com `cascadeOnDelete()` nas migrations.
- Complexidade da tela de pedido (itens dinâmicos em JS) gerar bugs de
  reindexação dos campos — mitigado recalculando os `name` de cada
  input a cada alteração de linha.

### Critérios de aceite
- [ ] Login funcionando com os usuários de teste do seeder
- [ ] CRUD de Fornecedores, Produtos e Pedidos 100% funcional
  (criar, listar, editar, excluir)
- [ ] Pedido calcula corretamente subtotal por item e total geral
- [ ] Todas as telas seguem o mesmo padrão visual (Skill de Identidade
  Visual)
- [ ] Validações e mensagens de erro em português em todos os formulários
- [ ] Pelo menos um MCP documentado (Laravel Boost MCP)
- [ ] README e RELATORIO.md completos na raiz do projeto