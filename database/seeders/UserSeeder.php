<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador
        User::firstOrCreate(
            ['email' => 'admin@trivia.com'],
            [
                'name' => 'Administrador',
                'nickname' => 'admin',
                'password' => Hash::make('Admin123'),
                'role' => 'administrador',
                'is_active' => true,
            ]
        );

        // Armador
        User::firstOrCreate(
            ['email' => 'armador@trivia.com'],
            [
                'name' => 'Armador',
                'nickname' => 'armador',
                'password' => Hash::make('Armador123'),
                'role' => 'armador',
                'is_active' => true,
            ]
        );

        // Jugador de prueba
        User::firstOrCreate(
            ['email' => 'jugador@trivia.com'],
            [
                'name' => 'Jugador Prueba',
                'nickname' => 'jugador',
                'password' => Hash::make('Jugador123'),
                'role' => 'jugador',
                'is_active' => true,
            ]
        );
    }
}