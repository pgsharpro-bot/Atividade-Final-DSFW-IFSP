<x-layouts.app :title="'Fornecedores'">
    <div class="flex justify-end">
        <a href="{{ route('fornecedores.create') }}"
           class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Novo Fornecedor</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3 text-left">Nome</th>
                    <th class="px-4 py-3 text-left">Cidade</th>
                    <th class="px-4 py-3 text-left">Contato</th>
                    <th class="px-4 py-3 text-left">WhatsApp/WeChat</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($fornecedores as $fornecedor)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('fornecedores.show', $fornecedor) }}" class="text-red-700 hover:underline font-medium">
                                {{ $fornecedor->nome }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $fornecedor->cidade }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $fornecedor->contato }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $fornecedor->whatsapp_wechat }}</td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ route('fornecedores.edit', $fornecedor) }}"
                               class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded-lg text-sm">Editar</a>
                            <form action="{{ route('fornecedores.destroy', $fornecedor) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este fornecedor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-white border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">Nenhum fornecedor cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $fornecedores->links() }}</div>
</x-layouts.app>