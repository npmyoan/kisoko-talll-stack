<?php

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Database\Seeders\CategorySeeder;

beforeEach(function () {
    $this->categoryRepository = new CategoryRepository;
});

it('should get all categories', function () {
    $this->seed(CategorySeeder::class);
    $categories = $this->categoryRepository->getAll();
    expect($categories->count())->toBeInt()->toBe(6);
});

it('should get category by id', function () {
    $this->seed(CategorySeeder::class);
    $category = $this->categoryRepository->getById(1);
    expect($category->name)->toContain('Café');
});

it('should delete category by id', function () {
    $this->seed(CategorySeeder::class);
    $categoriesStart = $this->categoryRepository->getAll();
    $this->categoryRepository->destroyById(1);
    $categoriesEnd = $this->categoryRepository->getAll();
    expect($categoriesEnd->count())->toBe($categoriesStart->count() - 1);
});

it('should create category', function () {
    $categoryCreate = new Category;
    $categoryCreate->name = 'Hostia';
    $categoryCreate->icon = 'hostia';
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
