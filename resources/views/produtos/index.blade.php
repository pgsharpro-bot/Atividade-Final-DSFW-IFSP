<x-layouts.app :title="'Produtos'">
    <div class="flex justify-end">
        <a href="{{ route('produtos.create') }}"
           class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Novo Produto</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3 text-left">Nome</th>
                    <th class="px-4 py-3 text-left">Fornecedor</th>
                    <th class="px-4 py-3 text-left">Categoria</th>
                    <th class="px-4 py-3 text-left">Preço (¥)</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($produtos as $produto)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('produtos.show', $produto) }}" class="text-red-700 hover:underline font-medium">
                                {{ $produto->nome }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $produto->fornecedor->nome }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $produto->categoria }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">¥ {{ number_format($produto->preco_unitario_cny, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ route('produtos.edit', $produto) }}"
                               class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded-lg text-sm">Editar</a>
                            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-white border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">Nenhum produto cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $produtos->links() }}</div>
</x-layouts.app>