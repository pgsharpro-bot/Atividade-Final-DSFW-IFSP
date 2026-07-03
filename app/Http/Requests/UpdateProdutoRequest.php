<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fornecedor_id' => ['required', 'exists:fornecedores,id'],
            'nome' => ['required', 'string', 'max:255'],
            'categoria' => ['nullable', 'string', 'max:255'],
            'preco_unitario_cny' => ['required', 'numeric', 'min:0'],
            'peso_kg' => ['nullable', 'numeric', 'min:0'],
            'link' => ['nullable', 'url', 'max:255'],
            'imagem_url' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'fornecedor_id.required' => 'Selecione o fornecedor do produto.',
            'fornecedor_id.exists' => 'Fornecedor inválido.',
            'nome.required' => 'O nome do produto é obrigatório.',
            'preco_unitario_cny.required' => 'Informe o preço unitário em CNY (Yuan).',
            'preco_unitario_cny.numeric' => 'O preço deve ser um número.',
        ];
    }
}
