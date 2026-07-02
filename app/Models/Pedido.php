<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor_id',
        'user_id',
        'status',
        'frete',
        'taxas',
        'data_pedido',
        'previsao_entrega',
        'observacoes',
    ];

    protected function casts(): array
    {
        return [
            'frete' => 'decimal:2',
            'taxas' => 'decimal:2',
            'data_pedido' => 'date',
            'previsao_entrega' => 'date',
        ];
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function custoTotalProdutosCny(): float
    {
        return $this->itens->sum(fn (PedidoItem $item) => $item->quantidade * $item->preco_unitario_cny);
    }
}