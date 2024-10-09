<?php

namespace App\Repositories;

use App\Business\ICategoryRepository;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentCategoryRepository implements ICategoryRepository
{
    public function getAll(): Collection
    {
        if (Cache::has('categories')) {
            return Cache::get('categories');
        }
        $categories = Category::all();
        Cache::put('categories', $categories, now()->addHours(2));

        return $categories;
    }

    public function getBySlug(string $slug): object
    {
        return Category::where('slug', operator: $slug)->first();
    }

    public function save(object $category): object
    {
        return Category::updateOrCreate(['name' => $category->name], $category->toArray());
    }

    public function destroyById(int $id): void
    {
        Category::destroy($id);
    }
}
