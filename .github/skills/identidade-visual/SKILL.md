---
name: identidade-visual
description: "Apply this skill whenever creating or editing any Blade view, layout, component, or CSS/Tailwind class in the ImportaChina project. Covers color palette, typography, spacing, responsividade, and standardization of all screens (login, dashboard, listagens, formulários). Use for every visual/UI task."
license: MIT
metadata:
  author: importa-china
---
# Identidade Visual — ImportaChina

Padrão visual único que todas as telas do sistema devem seguir.

## Paleta de cores (Tailwind)
- Primária (marca): `red-700` (#b91c1c) — remete à bandeira chinesa, usada em botões principais, links ativos e cabeçalho.
- Secundária: `amber-500` — usada em badges de status e destaques.
- Neutros: `slate-50` (fundo), `slate-800` (texto principal), `slate-500` (texto secundário).
- Status de pedido:
  - Cotação: `slate-400`
  - Pago: `blue-500`
  - Produção: `amber-500`
  - Enviado: `indigo-500`
  - Alfândega: `orange-500`
  - Entregue: `green-600`

## Tipografia
- Fonte padrão do sistema (`font-sans` do Tailwind).
- Títulos de página: `text-2xl font-bold text-slate-800`.
- Subtítulos/seções: `text-lg font-semibold text-slate-700`.
- Texto padrão: `text-sm text-slate-600`.

## Componentes padrão
- **Botão primário**: `bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium`.
- **Botão secundário/cancelar**: `bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm`.
- **Botão de excluir**: `bg-white border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm`.
- **Card/painel**: `bg-white rounded-xl shadow-sm border border-slate-200 p-6`.
- **Tabela de listagem**: cabeçalho `bg-slate-50 text-xs uppercase text-slate-500`, linhas com `hover:bg-slate-50`, divisórias `divide-y divide-slate-200`.
- **Badge de status**: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium` combinado com a cor do status acima.
- **Input de formulário**: `border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full`.
- **Mensagem de erro de validação**: `text-red-600 text-xs mt-1`.
- **Mensagem de sucesso (flash)**: `bg-green-50 text-green-700 border border-green-200 rounded-lg px-4 py-3 text-sm`.

## Layout
- Toda página autenticada usa um layout único (`layouts/app.blade.php`) com sidebar fixa à esquerda (menu: Dashboard, Fornecedores, Produtos, Pedidos) e conteúdo à direita.
- Sidebar: fundo `bg-slate-900`, itens de menu `text-slate-300 hover:bg-slate-800 hover:text-white`, item ativo `bg-red-700 text-white`.
- Responsividade: sidebar colapsa em menu hambúrguer abaixo de `md:` (breakpoint 768px); tabelas usam `overflow-x-auto` em telas pequenas.
- Espaçamento padrão entre seções: `space-y-6`; padding de página: `p-6`.

## Regras de padronização
1. Nunca usar cor fora da paleta definida acima.
2. Todo formulário de criar/editar reaproveita o mesmo partial de campos (`_form.blade.php`) quando possível.
3. Toda listagem segue a mesma estrutura: título da página + botão "Novo" à direita + tabela + paginação.
4. Ícones (quando usados) vêm de um único set (Heroicons via SVG inline), nunca misturar bibliotecas de ícones.
