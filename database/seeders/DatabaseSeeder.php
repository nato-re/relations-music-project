<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criação do Usuário A
        $userA = User::factory()->create([
            'name' => 'Usuário A',
            'email' => 'usuarioa@escola.com',
            'password' => Hash::make('senha123'),
        ]);

        // Criação do Usuário B
        $userB = User::factory()->create([
            'name' => 'Usuário B',
            'email' => 'usuariob@escola.com',
            'password' => Hash::make('senha123'),
        ]);

        // Criação de um Post pertencente ao Usuário B para demonstração da falha
        Post::create([
            'user_id' => 2,
            'conteudo' => 'Este é um post confidencial do Usuário B! Outros usuários não deveriam poder modificá-lo ou deletá-lo.',
        ]);
    }
}
