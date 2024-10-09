<?php

use App\Models\Category;
use App\Models\Product;
use App\Repositories\EloquentProductRepository;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->productRepository = new EloquentProductRepository;
});

it('should get all products', function () {
    $this->seed(CategorySeeder::class);
    $this->seed(ProductSeeder::class);
    $products = Product::all();
    $productsRepository = $this->productRepository->getAll();

    expect($productsRepository->count())->toBeInt()->toEqual($products->count());
});

it('should get product by category id', function () {
    $this->seed(CategorySeeder::class);
    $this->seed(ProductSeeder::class);
    $category = Category::first();
    $products = $category->products;
    $productsRepository = $this->productRepository->getByCategory($category->slug);

    expect($productsRepository->count())->toEqual($products->count());
});

it('should get product by id', function () {
    $this->seed(CategorySeeder::class);
    $this->seed(ProductSeeder::class);
    $product = Product::first();
    $productsRepository = $this->productRepository->getById($product->id);

    expect($productsRepository->name)->toBe('Café Caramel con Chocolate');
});

it('should create product', function () {
    $this->seed(CategorySeeder::class);

    $product = new Product;
    $product->name = 'Pastel1 arroz';
    $product->price = 60.45;
    $product->image = 'Pastel1';
    $product->category_id = 1;

    $productsRepository = $this->productRepository->create($product);

    expect($productsRepository->slug)->toBe($product->slug);
});

// it('should update product', function () {
//     $this->seed(CategorySeeder::class);
//     $product = Product::factory()->create();

//     $product->name = 'Pastel1 arroz1';
//     $product->price = 60;
//     $product->image = 'Pastel2';
//     $product->category_id = 2;

//     $productsRepository = $this->productRepository->update($product);

//     expect($productsRepository)->toBeInt()->toBe(1);
// });
