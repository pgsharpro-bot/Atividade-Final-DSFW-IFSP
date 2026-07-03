<div>
    <label for="fornecedor_id" class="block text-sm font-medium text-slate-700">Fornecedor *</label>
    <select name="fornecedor_id" id="fornecedor_id"
            class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        <option value="">Selecione...</option>
        @foreach ($fornecedores as $fornecedor)
            <option value="{{ $fornecedor->id }}"
                @selected(old('fornecedor_id', $produto->fornecedor_id ?? '') == $fornecedor->id)>
                {{ $fornecedor->nome }}
            </option>
        @endforeach
    </select>
    @error('fornecedor_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label for="nome" class="block text-sm font-medium text-slate-700">Nome do produto *</label>
    <input type="text" name="nome" id="nome" value="{{ old('nome', $produto->nome ?? '') }}"
           class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
    @error('nome') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label for="categoria" class="block text-sm font-medium text-slate-700">Categoria</label>
        <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $produto->categoria ?? '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('categoria') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="preco_unitario_cny" class="block text-sm font-medium text-slate-700">Preço unitário (¥ CNY) *</label>
        <input type="number" step="0.01" name="preco_unitario_cny" id="preco_unitario_cny"
               value="{{ old('preco_unitario_cny', $produto->preco_unitario_cny ?? '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('preco_unitario_cny') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="peso_kg" class="block text-sm font-medium text-slate-700">Peso (kg)</label>
        <input type="number" step="0.01" name="peso_kg" id="peso_kg" value="{{ old('peso_kg', $produto->peso_kg ?? '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('peso_kg') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="link" class="block text-sm font-medium text-slate-700">Link do produto</label>
    <input type="text" name="link" id="link" value="{{ old('link', $produto->link ?? '') }}" placeholder="https://..."
           class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
    @error('link') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label for="imagem_url" class="block text-sm font-medium text-slate-700">URL da imagem</label>
    <input type="text" name="imagem_url" id="imagem_url" value="{{ old('imagem_url', $produto->imagem_url ?? '') }}" placeholder="https://..."
           class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
    @error('imagem_url') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>