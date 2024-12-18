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

        return Cache::remember('categories', now()->addHours(2), fn () => Category::all());

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
