<x-layouts.app :title="'Editar Fornecedor'">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form method="POST" action="{{ route('fornecedores.update', $fornecedor) }}" class="space-y-4">
            @csrf
            @method('PUT')
            @include('fornecedores._form')

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('fornecedores.index') }}"
                   class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm">Cancelar</a>
                <button type="submit"
                        class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium">Atualizar</button>
            </div>
        </form>
    </div>
</x-layouts.app>