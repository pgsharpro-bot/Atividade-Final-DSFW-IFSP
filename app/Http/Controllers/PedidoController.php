<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Fornecedor;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function index(): View
    {
        $pedidos = Pedido::with('fornecedor')->latest()->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function create(): View
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();

        return view('pedidos.create', compact('fornecedores', 'produtos'));
    }

    public function store(StorePedidoRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $pedido = Pedido::create([
                ...$request->safe()->except('itens'),
                'user_id' => auth()->id(),
            ]);

            $pedido->itens()->createMany($request->validated('itens'));
        });

        return redirect()->route('pedidos.index')->with('success', 'Pedido cadastrado com sucesso.');
    }

    public function show(Pedido $pedido): View
    {
        $pedido->load(['fornecedor', 'usuario', 'itens.produto']);

        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido): View
    {
        $pedido->load('itens');
        $fornecedores = Fornecedor::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();

        return view('pedidos.edit', compact('pedido', 'fornecedores', 'produtos'));
    }

    public function update(UpdatePedidoRequest $request, Pedido $pedido): RedirectResponse
    {
        DB::transaction(function () use ($request, $pedido) {
            $pedido->update($request->safe()->except('itens'));

            $pedido->itens()->delete();
            $pedido->itens()->createMany($request->validated('itens'));
        });

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido): RedirectResponse
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }
}