<x-layouts.app :title="'Pedido #'.$pedido->id">
    @php
        $statusLabels = [
            'cotacao' => 'Cotação',
            'pago' => 'Pago',
            'producao' => 'Produção',
            'enviado' => 'Enviado',
            'alfandega' => 'Alfândega',
            'entregue' => 'Entregue',
        ];
        $totalProdutos = $pedido->custoTotalProdutosCny();
        $totalGeral = $totalProdutos + $pedido->frete + $pedido->taxas;
    @endphp

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4 max-w-3xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><span class="text-slate-500 text-sm">Fornecedor:</span> {{ $pedido->fornecedor->nome }}</div>
            <div><span class="text-slate-500 text-sm">Status:</span> {{ $statusLabels[$pedido->status] ?? $pedido->status }}</div>
            <div><span class="text-slate-500 text-sm">Data do pedido:</span> {{ $pedido->data_pedido?->format('d/m/Y') }}</div>
            <div><span class="text-slate-500 text-sm">Previsão de entrega:</span> {{ $pedido->previsao_entrega?->format('d/m/Y') ?? '—' }}</div>
            <div><span class="text-slate-500 text-sm">Solicitado por:</span> {{ $pedido->usuario->name ?? '—' }}</div>
        </div>

        @if ($pedido->observacoes)
            <div><span class="text-slate-500 text-sm">Observações:</span> {{ $pedido->observacoes }}</div>
        @endif

        <div class="border-t border-slate-200 pt-4">
            <h3 class="text-sm font-semibold text-slate-700 mb-2">Itens do pedido</h3>
            <table class="min-w-full text-sm">
                <thead class="text-xs uppercase text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="text-left py-2">Produto</th>
                        <th class="text-left py-2">Qtd.</th>
                        <th class="text-left py-2">Preço unit. (¥)</th>
                        <th class="text-left py-2">Subtotal (¥)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($pedido->itens as $item)
                        <tr>
                            <td class="py-2">{{ $item->produto->nome ?? 'Produto removido' }}</td>
                            <td class="py-2">{{ $item->quantidade }}</td>
                            <td class="py-2">¥ {{ number_format($item->preco_unitario_cny, 2, ',', '.') }}</td>
                            <td class="py-2">¥ {{ number_format($item->quantidade * $item->preco_unitario_cny, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 pt-4 text-sm space-y-1 text-right">
            <div>Subtotal produtos: ¥ {{ number_format($totalProdutos, 2, ',', '.') }}</div>
            <div>Frete: ¥ {{ number_format($pedido->frete, 2, ',', '.') }}</div>
            <div>Taxas: ¥ {{ number_format($pedido->taxas, 2, ',', '.') }}</div>
            <div class="font-semibold text-base pt-1">Total geral: ¥ {{ number_format($totalGeral, 2, ',', '.') }}</div>
        </div>

        <a href="{{ route('pedidos.index') }}" class="text-red-700 hover:underline text-sm">← Voltar para a lista</a>
    </div>
</x-layouts.app>