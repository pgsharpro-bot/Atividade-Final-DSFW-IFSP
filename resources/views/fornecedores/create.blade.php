<x-layouts.app :title="'Novo Fornecedor'">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form method="POST" action="{{ route('fornecedores.store') }}" class="space-y-4">
            @csrf
            @include('fornecedores._form')

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('fornecedores.index') }}"
                   class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm">Cancelar</a>
                <button type="submit"
                        class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium">Salvar</button>
            </div>
        </form>
    </div>
</x-layouts.app>