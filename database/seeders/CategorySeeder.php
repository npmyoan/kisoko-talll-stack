<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Café',
            'icon' => 'coffee',
        ]);

        Category::create([
            'name' => 'Hamburguesas',
            'icon' => 'hamburger',
        ]);

        Category::create([
            'name' => 'Pizzas',
            'icon' => 'pizza',
        ]);

        Category::create([
            'name' => 'Donas',
            'icon' => 'dona',
        ]);

        Category::create([
            'name' => 'Pasteles',
            'icon' => 'cake',
        ]);

        Category::create([
            'name' => 'Galletas',
            'icon' => 'cookie',
        ]);
    }
}
