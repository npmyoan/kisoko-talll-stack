<?php

namespace App\Repositories;

use App\Business\IProductRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class EloquentProductRepository implements IProductRepository
{
    public function getAll(): Collection
    {
        return Cache::remember('products', now()->addHours(2), fn () => Product::where('available', 1)->get());
    }

    public function getByCategory(string $category): Collection
    {
        return Category::where('slug', $category)->first()->products;
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

        return Product::where('id', $product->id)->update($product->toArray());

    }

    public function destroyById(int $id): void
    {
        Product::destroy($id);
    }

    public function available(int $id): Product
    {
        $product = Product::findOrFail($id);

        $product->update(['available' => $product->available ? 0 : 1]);
        Cache::forget('products');

        return $product;
    }
}
