@php
    $statusOptions = [
        'cotacao' => 'Cotação',
        'pago' => 'Pago',
        'producao' => 'Produção',
        'enviado' => 'Enviado',
        'alfandega' => 'Alfândega',
        'entregue' => 'Entregue',
    ];
    $itensAntigos = old('itens', isset($pedido)
        ? $pedido->itens->map(fn ($item) => [
            'produto_id' => $item->produto_id,
            'quantidade' => $item->quantidade,
            'preco_unitario_cny' => $item->preco_unitario_cny,
        ])->toArray()
        : []);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="fornecedor_id" class="block text-sm font-medium text-slate-700">Fornecedor *</label>
        <select name="fornecedor_id" id="fornecedor_id"
                class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
            <option value="">Selecione...</option>
            @foreach ($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}"
                    @selected(old('fornecedor_id', $pedido->fornecedor_id ?? '') == $fornecedor->id)>
                    {{ $fornecedor->nome }}
                </option>
            @endforeach
        </select>
        @error('fornecedor_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-slate-700">Status *</label>
        <select name="status" id="status"
                class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
            @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}"
                    @selected(old('status', $pedido->status ?? 'cotacao') == $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
        <label for="data_pedido" class="block text-sm font-medium text-slate-700">Data do pedido *</label>
        <input type="date" name="data_pedido" id="data_pedido"
               value="{{ old('data_pedido', isset($pedido) ? $pedido->data_pedido?->format('Y-m-d') : now()->format('Y-m-d')) }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('data_pedido') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="previsao_entrega" class="block text-sm font-medium text-slate-700">Previsão de entrega</label>
        <input type="date" name="previsao_entrega" id="previsao_entrega"
               value="{{ old('previsao_entrega', isset($pedido) ? $pedido->previsao_entrega?->format('Y-m-d') : '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('previsao_entrega') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="frete" class="block text-sm font-medium text-slate-700">Frete (¥)</label>
        <input type="number" step="0.01" name="frete" id="frete" value="{{ old('frete', $pedido->frete ?? 0) }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('frete') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="taxas" class="block text-sm font-medium text-slate-700">Taxas (¥)</label>
        <input type="number" step="0.01" name="taxas" id="taxas" value="{{ old('taxas', $pedido->taxas ?? 0) }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('taxas') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="observacoes" class="block text-sm font-medium text-slate-700">Observações</label>
    <textarea name="observacoes" id="observacoes" rows="2"
              class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">{{ old('observacoes', $pedido->observacoes ?? '') }}</textarea>
    @error('observacoes') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="border-t border-slate-200 pt-4">
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-sm font-semibold text-slate-700">Itens do pedido *</h3>
        <button type="button" id="add-item"
                class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium">
            + Adicionar item
        </button>
    </div>
    @error('itens') <p class="text-red-600 text-xs mb-2">{{ $message }}</p> @enderror

    <div id="itens-container" class="space-y-2"></div>
</div>

{{-- Template de linha (não enviado, clonado via JS) --}}
<template id="item-template">
    <div class="item-row grid grid-cols-12 gap-2 items-start bg-slate-50 border border-slate-200 rounded-lg p-3">
        <div class="col-span-5">
            <select class="item-produto border-slate-300 rounded-lg shadow-sm text-sm w-full">
                <option value="">Selecione o produto...</option>
                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_unitario_cny }}">
                        {{ $produto->nome }} ({{ $produto->fornecedor->nome ?? 's/ fornecedor' }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2">
            <input type="number" min="1" value="1" class="item-quantidade border-slate-300 rounded-lg shadow-sm text-sm w-full" placeholder="Qtd">
        </div>
        <div class="col-span-2">
            <input type="number" step="0.01" min="0" class="item-preco border-slate-300 rounded-lg shadow-sm text-sm w-full" placeholder="¥ Unit.">
        </div>
        <div class="col-span-2 flex items-center text-sm text-slate-600 pt-2">
            <span class="item-subtotal">¥ 0,00</span>
        </div>
        <div class="col-span-1 text-right">
            <button type="button" class="remove-item text-red-600 hover:text-red-800 text-sm pt-2">✕</button>
        </div>
    </div>
</template>

<div class="text-right text-sm font-semibold text-slate-700 pt-2">
    Total dos itens: <span id="total-itens">¥ 0,00</span>
</div>

<script>
(function () {
    const container = document.getElementById('itens-container');
    const template = document.getElementById('item-template');
    const addBtn = document.getElementById('add-item');
    const totalEl = document.getElementById('total-itens');
    const itensExistentes = @json($itensAntigos);

    function formatMoney(value) {
        return '¥ ' + Number(value || 0).toFixed(2).replace('.', ',');
    }

    function recalcularTotais() {
        let total = 0;
        container.querySelectorAll('.item-row').forEach((row, index) => {
            const qtd = parseFloat(row.querySelector('.item-quantidade').value) || 0;
            const preco = parseFloat(row.querySelector('.item-preco').value) || 0;
            const subtotal = qtd * preco;
            row.querySelector('.item-subtotal').textContent = formatMoney(subtotal);
            total += subtotal;

            // Reindexa os names para o formato itens[N][campo]
            row.querySelector('.item-produto').setAttribute('name', `itens[${index}][produto_id]`);
            row.querySelector('.item-quantidade').setAttribute('name', `itens[${index}][quantidade]`);
            row.querySelector('.item-preco').setAttribute('name', `itens[${index}][preco_unitario_cny]`);
        });
        totalEl.textContent = formatMoney(total);
    }

    function addRow(dados) {
        const clone = template.content.cloneNode(true);
        const row = clone.querySelector('.item-row');
        const selectProduto = row.querySelector('.item-produto');
        const inputQtd = row.querySelector('.item-quantidade');
        const inputPreco = row.querySelector('.item-preco');
        const removeBtn = row.querySelector('.remove-item');

        if (dados) {
            selectProduto.value = dados.produto_id ?? '';
            inputQtd.value = dados.quantidade ?? 1;
            inputPreco.value = dados.preco_unitario_cny ?? '';
        }

        selectProduto.addEventListener('change', function () {
            const opt = this.selectedOptions[0];
            if (opt && opt.dataset.preco && !inputPreco.value) {
                inputPreco.value = opt.dataset.preco;
            }
            recalcularTotais();
        });
        inputQtd.addEventListener('input', recalcularTotais);
        inputPreco.addEventListener('input', recalcularTotais);
        removeBtn.addEventListener('click', function () {
            row.remove();
            recalcularTotais();
        });

        container.appendChild(row);
        recalcularTotais();
    }

    addBtn.addEventListener('click', () => addRow());

    if (itensExistentes.length > 0) {
        itensExistentes.forEach(item => addRow(item));
    } else {
        addRow();
    }
})();
</script>