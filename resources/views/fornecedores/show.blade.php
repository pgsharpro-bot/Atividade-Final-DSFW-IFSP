<x-layouts.app :title="$fornecedor->nome">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4 max-w-2xl">
        <div><span class="text-slate-500 text-sm">Cidade / País:</span> {{ $fornecedor->cidade }} - {{ $fornecedor->pais }}</div>
        <div><span class="text-slate-500 text-sm">Contato:</span> {{ $fornecedor->contato }}</div>
        <div><span class="text-slate-500 text-sm">WhatsApp/WeChat:</span> {{ $fornecedor->whatsapp_wechat }}</div>
        <div><span class="text-slate-500 text-sm">Site:</span> {{ $fornecedor->site }}</div>
        <div><span class="text-slate-500 text-sm">Observações:</span> {{ $fornecedor->observacoes }}</div>
        <div><span class="text-slate-500 text-sm">Produtos cadastrados:</span> {{ $fornecedor->produtos->count() }}</div>
        <div><span class="text-slate-500 text-sm">Pedidos:</span> {{ $fornecedor->pedidos->count() }}</div>

        <a href="{{ route('fornecedores.index') }}" class="text-red-700 hover:underline text-sm">← Voltar para a lista</a>
    </div>
</x-layouts.app>