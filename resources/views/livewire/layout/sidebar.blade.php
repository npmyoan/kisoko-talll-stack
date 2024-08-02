<?php

use function Livewire\Volt\{state};
use Gloudemans\Shoppingcart\Facades\Cart;

state([
    'categories' => [
        [
            'icon' => 'cafe',
            'name' => 'Café',
            'id' => 1,
        ],
        [
            'icon' => 'hamburguesa',
            'name' => 'Hamburguesas',
            'id' => 2,
        ],
        [
            'icon' => 'pizza',
            'name' => 'Pizzas',
            'id' => 3,
        ],
        [
            'icon' => 'dona',
            'name' => 'Donas',
            'id' => 4,
        ],
        [
            'icon' => 'pastel',
            'name' => 'Pasteles',
            'id' => 5,
        ],
        [
            'icon' => 'galletas',
            'name' => 'Galletas',
            'id' => 6,
        ],
    ],
]);

$cancelOrder = function () {
    Cart::destroy();
    $this->dispatch('destroy_cart');
};

?>

<aside class="md:w-72">
    <div class="p-4">
        <img class="w-32" src=" {{ asset('storage/img/logo.jpg') }} " alt="logo" />
    </div>
    <div class="mt-2">
        @foreach ($categories as $category)
            <livewire:layout.sidebaritem :$category :key="$category['id']" />
        @endforeach
    </div>

    <div class="my-5 px-5">
        <button wire:click='cancelOrder' type="button"
            class="w-full truncate bg-red-500 p-3 text-center font-bold text-white">
            Cancelar Orden
        </button>
    </div>
</aside>
