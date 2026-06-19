<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        Level::create([
            'name' => 'Básico',
            'order' => 1,
            'description' => 'Nivel básico para principiantes',
        ]);

        Level::create([
            'name' => 'Intermedio',
            'order' => 2,
            'description' => 'Nivel intermedio para usuarios con experiencia',
        ]);

        Level::create([
            'name' => 'Avanzado',
            'order' => 3,
            'description' => 'Nivel avanzado para expertos',
        ]);
    }
}