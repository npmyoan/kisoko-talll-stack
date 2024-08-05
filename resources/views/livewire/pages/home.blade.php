<?php

use function Livewire\Volt\{state, mount, layout, on};

use App\Business\IProductRepository;

state([
    'products' => [],
]);

mount(function (IProductRepository $product) {
    $this->products = $product->getAll();
});

on([
    'filter-products' => function ($products) {
        $this->products = $products;
    },
]);

layout('layouts.default');

?>

<div>
    <h1 class="text-4xl font-black">Inicio</h1>
    <p class="my-12 text-2xl">Elige y perzonaliza tu pedido a continuación</p>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <livewire:components.productcard :$product :key="$product['id']" />
        @empty
            No hay Productos
        @endforelse
    </div>
</div>
