<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fornecedor_id' => ['required', 'exists:fornecedores,id'],
            'status' => ['required', 'in:cotacao,pago,producao,enviado,alfandega,entregue'],
            'data_pedido' => ['required', 'date'],
            'previsao_entrega' => ['nullable', 'date', 'after_or_equal:data_pedido'],
            'frete' => ['nullable', 'numeric', 'min:0'],
            'taxas' => ['nullable', 'numeric', 'min:0'],
            'observacoes' => ['nullable', 'string'],
            'itens' => ['required', 'array', 'min:1'],
            'itens.*.produto_id' => ['required', 'exists:produtos,id'],
            'itens.*.quantidade' => ['required', 'integer', 'min:1'],
            'itens.*.preco_unitario_cny' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'fornecedor_id.required' => 'Selecione o fornecedor do pedido.',
            'data_pedido.required' => 'Informe a data do pedido.',
            'previsao_entrega.after_or_equal' => 'A previsão de entrega não pode ser anterior à data do pedido.',
            'itens.required' => 'Adicione pelo menos um item ao pedido.',
            'itens.min' => 'Adicione pelo menos um item ao pedido.',
            'itens.*.produto_id.required' => 'Selecione o produto do item.',
            'itens.*.quantidade.required' => 'Informe a quantidade do item.',
            'itens.*.preco_unitario_cny.required' => 'Informe o preço unitário do item.',
        ];
    }
}