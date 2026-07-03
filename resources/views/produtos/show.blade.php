<x-layouts.app :title="$produto->nome">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4 max-w-2xl">
        @if ($produto->imagem_url)
    <img src="{{ $produto->imagem_url }}" alt="{{ $produto->nome }}"
         class="w-full max-w-xs rounded-lg border border-slate-200 object-cover"
         onerror="this.style.display='none'">
@endif
        <div><span class="text-slate-500 text-sm">Fornecedor:</span> {{ $produto->fornecedor->nome }}</div>
        <div><span class="text-slate-500 text-sm">Categoria:</span> {{ $produto->categoria }}</div>
        <div><span class="text-slate-500 text-sm">Preço unitário:</span> ¥ {{ number_format($produto->preco_unitario_cny, 2, ',', '.') }}</div>
        <div><span class="text-slate-500 text-sm">Peso:</span> {{ $produto->peso_kg }} kg</div>
        <div><span class="text-slate-500 text-sm">Link:</span> {{ $produto->link }}</div>

        <a href="{{ route('produtos.index') }}" class="text-red-700 hover:underline text-sm">← Voltar para a lista</a>
    </div>
</x-layouts.app>