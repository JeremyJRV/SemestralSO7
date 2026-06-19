<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        Theme::create([
            'name' => 'PHP',
            'description' => 'Preguntas sobre PHP y programación backend',
            'icon_path' => '/images/php-icon.png',
            'is_active' => true,
        ]);

        Theme::create([
            'name' => 'JavaScript',
            'description' => 'Preguntas sobre JavaScript y frontend',
            'icon_path' => '/images/js-icon.png',
            'is_active' => true,
        ]);

        Theme::create([
            'name' => 'Laravel',
            'description' => 'Preguntas sobre Laravel framework',
            'icon_path' => '/images/laravel-icon.png',
            'is_active' => true,
        ]);
    }
}