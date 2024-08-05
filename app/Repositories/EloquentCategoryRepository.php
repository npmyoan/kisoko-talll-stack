<?php

namespace App\Repositories;

use App\Business\ICategoryRepository;
use App\Models\Category;
use Illuminate\Support\Collection;

class EloquentCategoryRepository implements ICategoryRepository
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function getById(int $id): object
    {
        return Category::find($id);
    }

    public function save(object $category): object
    {
        return Category::updateOrCreate(['name' => $category->name], $category->toArray());
    }

    public function destroyById(int $id): void
    {
        Category::find($id)->delete();
    }
}
