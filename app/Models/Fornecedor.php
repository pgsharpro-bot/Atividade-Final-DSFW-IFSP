<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'cidade',
        'pais',
        'contato',
        'whatsapp_wechat',
        'site',
        'observacoes',
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}