<?php

namespace Database\Seeders;

use App\Models\Category;
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
            'slug' => 'cafe',
            'icon' => 'coffee',
        ]);

        Category::create([
            'name' => 'Hamburguesas',
            'slug' => 'hamburguesa',
            'icon' => 'hamburger',
        ]);

        Category::create([
            'name' => 'Pizzas',
            'slug' => 'pizza',
            'icon' => 'pizza',
        ]);

        Category::create([
            'name' => 'Donas',
            'slug' => 'donas',
            'icon' => 'dona',
        ]);

        Category::create([
            'name' => 'Pasteles',
            'slug' => 'pasteles',
            'icon' => 'cake',
        ]);

        Category::create([
            'name' => 'Galletas',
            'slug' => 'galletas',
            'icon' => 'cookie',
        ]);
    }
}
