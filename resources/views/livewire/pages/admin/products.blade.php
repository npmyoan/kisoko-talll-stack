<?php

use function Livewire\Volt\{state, mount, layout, on};
use App\Livewire\Actions\Logout;

use App\Business\IProductRepository;
use App\Business\ICategoryRepository;
use App\Models\Product;

layout('layouts.app');

state([
    'products' => [],
    'categoryName' => 'Todos los productos',
]);

mount(function (IProductRepository $product) {
    $this->products = $product->getAll();
});

on([
    'filter-products' => function ($categoryId, IProductRepository $product, ICategoryRepository $categoryS) {
        $this->categoryName = $categoryS->getById($categoryId)->name;
        $this->products = $product->getByCategory($categoryId);
    },
]);

on([
    'is-stock' => function (IProductRepository $products) {
        $this->products = $products->getAll();
    },
]);

on([
    'search-products' => function (string $search) {
        $products = Product::where('name', 'like', '%' . $search . '%')->get();
        $this->products = $products;
    },
]);

$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};

?>

<div class="relative">
    <div class="flex justify-end">
        <a class="mb-4 flex items-center gap-3 rounded-md bg-emerald-500 px-4 py-2 text-slate-200 transition-colors hover:bg-emerald-800"
            href="{{ route('admin.products.create') }}" wire:navigate>
            <img src="{{ asset('storage/icons/plus.svg') }}" class="text-white">
            Nuevo producto
        </a>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <livewire:components.productcardadmin :$product :key="$product->id" />
        @empty
            No hay Productos
        @endforelse
    </div>
</div>
