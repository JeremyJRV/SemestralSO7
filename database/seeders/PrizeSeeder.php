<?php

namespace Database\Seeders;

use App\Models\Prize;
use Illuminate\Database\Seeder;

class PrizeSeeder extends Seeder
{
    public function run()
    {
        Prize::create([
            'name' => 'Principiante',
            'description' => 'Premio por completar nivel básico',
            'image_path' => '/images/prize-beginner.png',
            'points_value' => 50,
            'is_active' => true,
        ]);

        Prize::create([
            'name' => 'Experto',
            'description' => 'Premio por completar nivel intermedio',
            'image_path' => '/images/prize-expert.png',
            'points_value' => 100,
            'is_active' => true,
        ]);

        Prize::create([
            'name' => 'Maestro',
            'description' => 'Premio por completar nivel avanzado',
            'image_path' => '/images/prize-master.png',
            'points_value' => 200,
            'is_active' => true,
        ]);
    }
}