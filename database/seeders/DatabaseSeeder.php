<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin ImportaChina',
            'email' => 'admin@importachina.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Operador Teste',
            'email' => 'operador@importachina.com',
            'password' => bcrypt('password'),
            'role' => 'operador',
        ]);

        $this->call([
            FornecedorSeeder::class,
            ProdutoSeeder::class,
            PedidoSeeder::class,
        ]);
    }
}