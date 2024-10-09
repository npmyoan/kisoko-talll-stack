<?php

use App\Models\Category;
use App\Repositories\EloquentCategoryRepository;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->categoryRepository = new EloquentCategoryRepository;
});

it('should get all categories', function () {
    $this->seed(CategorySeeder::class);
    $categories = Category::all();
    $categoriesRepository = $this->categoryRepository->getAll();
    expect($categoriesRepository->count())->toBeInt()->toBe($categories->count());
});

it('should get category by slug', function () {
    $this->seed(CategorySeeder::class);
    $categoryFirst = Category::first();

    $category = $this->categoryRepository->getBySlug($categoryFirst->slug);

    expect($category->name)->toContain($categoryFirst->name);
});

it('should delete category by id', function () {
    $this->seed(CategorySeeder::class);
    $categoriesStart = $this->categoryRepository->getAll();
    $category = Category::first();

    $this->categoryRepository->destroyById($category->id);

    $categoriesEnd = Category::where('deleted', '!=', null)->get();

    expect($categoriesStart->count() - 1)->toBe($categoriesEnd->count());
});

it('should create category', function () {
    $categoryCreate = new Category;
    $name = $categoryCreate->name = 'Hostia';
    $categoryCreate->icon = 'hostia';
    $categoryCreate->slug = Str::slug($name);

    $this->categoryRepository->save($categoryCreate);
    $categoryQuery = Category::whereName('Hostia')->first();
    expect($categoryCreate->name)->toBe($categoryQuery->name);
});

it('should update category', function () {
    $this->seed(CategorySeeder::class);
    $categoryCreate = new Category;
    $categoryCreate->name = 'Café';
    $categoryCreate->icon = 'cafe1';
    $this->categoryRepository->save($categoryCreate);
    $categoryQuery = Category::whereName('Café')->first();
    expect($categoryCreate->icon)->toBe($categoryQuery->icon);
});
