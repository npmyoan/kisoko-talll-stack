<?php

use App\Repositories\EloquentProductRepository;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->productRepository = new EloquentProductRepository;
});

describe('<Home />', function () {

    it('logout', function () {

        Volt::test('pages.home')
            ->call('logout')
            ->assertStatus(200)
            ->assertRedirect('/');

    });

    it('products renders', function () {
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        Volt::test('pages.home')
            ->assertStatus(200)
            ->assertSeeVolt('components.productcard');
    });

});
