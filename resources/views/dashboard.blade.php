<x-layouts.app :title="'Dashboard'">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-slate-700">
            Bem-vindo(a), {{ auth()->user()->name }}! Use o menu ao lado para
            gerenciar fornecedores, produtos e pedidos de importação.
        </p>
    </div>
</x-layouts.app>