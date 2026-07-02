<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor_id',
        'nome',
        'categoria',
        'preco_unitario_cny',
        'peso_kg',
        'link',
        'imagem_url',
    ];

    protected function casts(): array
    {
        return [
            'preco_unitario_cny' => 'decimal:2',
            'peso_kg' => 'decimal:2',
        ];
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function pedidoItens(): HasMany
    {
        return $this->hasMany(PedidoItem::class);
    }
}