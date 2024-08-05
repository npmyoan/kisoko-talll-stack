<?php

namespace App\Repositories;

use App\Business\IProductRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EloquentProductRepository implements IProductRepository
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getByCategory(int $id): Collection
    {
        return Category::findOrFail($id)->products->get();
    }

    public function getById(int $id): object
    {
        return Product::find($id);

    }

    public function save(object $product): object
    {
        $product->slug = Str::slug($product->name);

        return Product::updateOrCreate(['slug' => $product->slug], $product->toArray());

    }

    public function destroyById(int $id): void
    {
        Product::destroy($id);
    }
}
