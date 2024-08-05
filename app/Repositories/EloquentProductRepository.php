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
        return Category::findOrFail($id)->products;
    }

    public function getById(int $id): object
    {
        return Product::find($id);
    }

    public function create(object $product): object
    {
        $product->slug = Str::slug($product->name);
        $category = Category::findOrFail($product->category_id);

        return $category->products()->create([
            'name' => $product->name,
            'price' => $product->price,
            'slug' => $product->slug,
            'image' => $product->image,
        ]);
    }

    public function update(object $product): int
    {
        if (isset($product->name)) {
            $product->slug = Str::slug($product->name);
        }

        $category = Category::findOrFail($product->category_id);

        return $category->products()->where('id', $product->id)->update($product->toArray());
    }

    public function destroyById(int $id): void
    {
        Product::destroy($id);
    }
}
