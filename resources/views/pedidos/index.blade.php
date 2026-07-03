<x-layouts.app :title="'Pedidos'">
    <div class="flex justify-end">
        <a href="{{ route('pedidos.create') }}"
           class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Novo Pedido</a>
    </div>

    @php
        $statusColors = [
            'cotacao' => 'bg-slate-100 text-slate-700',
            'pago' => 'bg-blue-100 text-blue-700',
            'producao' => 'bg-yellow-100 text-yellow-700',
            'enviado' => 'bg-purple-100 text-purple-700',
            'alfandega' => 'bg-orange-100 text-orange-700',
            'entregue' => 'bg-green-100 text-green-700',
        ];
        $statusLabels = [
            'cotacao' => 'Cotação',
            'pago' => 'Pago',
            'producao' => 'Produção',
            'enviado' => 'Enviado',
            'alfandega' => 'Alfândega',
            'entregue' => 'Entregue',
        ];
    @endphp

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Fornecedor</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Data do pedido</th>
                    <th class="px-4 py-3 text-left">Previsão</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($pedidos as $pedido)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('pedidos.show', $pedido) }}" class="text-red-700 hover:underline font-medium">
                                #{{ $pedido->id }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $pedido->fornecedor->nome }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$pedido->status] ?? 'bg-slate-100 text-slate-700' }}">
                                {{ $statusLabels[$pedido->status] ?? $pedido->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $pedido->data_pedido?->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $pedido->previsao_entrega?->format('d/m/Y') ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ route('pedidos.edit', $pedido) }}"
                               class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded-lg text-sm">Editar</a>
                            <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este pedido?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-white border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">Nenhum pedido cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $pedidos->links() }}</div>
</x-layouts.app>