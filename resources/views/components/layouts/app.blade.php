<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ImportaChina' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex md:flex-col">
            <div class="px-6 py-5 border-b border-slate-800">
                <span class="text-white font-bold text-lg">🇨🇳 ImportaChina</span>
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('dashboard') ? 'bg-red-700 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ Route::has('fornecedores.index') ? route('fornecedores.index') : '#' }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('fornecedores.*') ? 'bg-red-700 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    Fornecedores
                </a>
                <a href="{{ Route::has('produtos.index') ? route('produtos.index') : '#' }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('produtos.*') ? 'bg-red-700 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    Produtos
                </a>
                <a href="{{ Route::has('pedidos.index') ? route('pedidos.index') : '#' }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('pedidos.*') ? 'bg-red-700 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    Pedidos
                </a>
            </nav>
            <div class="px-3 py-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm hover:bg-slate-800 hover:text-white">
                        Sair ({{ auth()->user()->name }})
                    </button>
                </form>
            </div>
        </aside>

        {{-- Conteúdo --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-slate-200 px-6 py-4">
                <h1 class="text-2xl font-bold text-slate-800">{{ $title ?? 'ImportaChina' }}</h1>
            </header>

            <main class="flex-1 p-6 space-y-6">
                @if (session('success'))
                    <div class="bg-green-50 text-green-700 border border-green-200 rounded-lg px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>