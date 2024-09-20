<?php

use function Livewire\Volt\{state, mount, layout, on};
use App\Livewire\Actions\Logout;

use App\Business\IProductRepository;
use App\Business\ICategoryRepository;

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

$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};

?>

<div class="relative">
    <div class="flex justify-end">
        <a
            class="px-4 mb-4  py-2 bg-emerald-500 text-slate-200 flex gap-3 items-center rounded-md hover:bg-emerald-800 transition-colors"
            href="{{route('admin.products.create')}}"
            wire:navigate
        >
            <img src="{{asset('storage/icons/plus.svg')}}" class="text-white">
            Nuevo producto
        </a>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <livewire:components.productcardadmin :$product :key="$product->id"/>
        @empty
            No hay Productos
        @endforelse
    </div>
</div>
