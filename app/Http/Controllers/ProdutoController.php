<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index(): View
    {
        $produtos = Produto::with('fornecedor')->latest()->paginate(10);

        return view('produtos.index', compact('produtos'));
    }

    public function create(): View
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();

        return view('produtos.create', compact('fornecedores'));
    }

    public function store(StoreProdutoRequest $request): RedirectResponse
    {
        Produto::create($request->validated());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function show(Produto $produto): View
    {
        $produto->load('fornecedor');

        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto): View
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();

        return view('produtos.edit', compact('produto', 'fornecedores'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto): RedirectResponse
    {
        $produto->update($request->validated());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}
