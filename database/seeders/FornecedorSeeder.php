<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        Fornecedor::factory()->count(6)->create();
    }
}