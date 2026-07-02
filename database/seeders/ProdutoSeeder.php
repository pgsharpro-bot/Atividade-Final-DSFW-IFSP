<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Fornecedor::all()->each(function (Fornecedor $fornecedor) {
            Produto::factory()
                ->count(rand(2, 5))
                ->create(['fornecedor_id' => $fornecedor->id]);
        });
    }
}