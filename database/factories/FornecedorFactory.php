<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->company(),
            'cidade' => fake()->randomElement(['Guangzhou', 'Shenzhen', 'Yiwu', 'Ningbo', 'Shanghai']),
            'pais' => 'China',
            'contato' => fake()->name(),
            'whatsapp_wechat' => fake()->numerify('+86 ### #### ####'),
            'site' => fake()->url(),
            'observacoes' => fake()->optional()->sentence(),
        ];
    }
}