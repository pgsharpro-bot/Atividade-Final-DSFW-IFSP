<div>
    <label for="nome" class="block text-sm font-medium text-slate-700">Nome *</label>
    <input type="text" name="nome" id="nome" value="{{ old('nome', $fornecedor->nome ?? '') }}"
           class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
    @error('nome') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="cidade" class="block text-sm font-medium text-slate-700">Cidade</label>
        <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $fornecedor->cidade ?? '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('cidade') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="pais" class="block text-sm font-medium text-slate-700">País</label>
        <input type="text" name="pais" id="pais" value="{{ old('pais', $fornecedor->pais ?? 'China') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('pais') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="contato" class="block text-sm font-medium text-slate-700">Contato</label>
        <input type="text" name="contato" id="contato" value="{{ old('contato', $fornecedor->contato ?? '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('contato') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="whatsapp_wechat" class="block text-sm font-medium text-slate-700">WhatsApp / WeChat</label>
        <input type="text" name="whatsapp_wechat" id="whatsapp_wechat" value="{{ old('whatsapp_wechat', $fornecedor->whatsapp_wechat ?? '') }}"
               class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
        @error('whatsapp_wechat') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="site" class="block text-sm font-medium text-slate-700">Site</label>
    <input type="text" name="site" id="site" value="{{ old('site', $fornecedor->site ?? '') }}"
           placeholder="https://..."
           class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">
    @error('site') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label for="observacoes" class="block text-sm font-medium text-slate-700">Observações</label>
    <textarea name="observacoes" id="observacoes" rows="3"
              class="mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-red-600 focus:border-red-600 text-sm w-full">{{ old('observacoes', $fornecedor->observacoes ?? '') }}</textarea>
    @error('observacoes') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>