<?php

use function Livewire\Volt\{state, mount, on};
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Business\ICategoryRepository;

state([
    'categories' => [],
]);

mount(function (ICategoryRepository $category) {
    $this->categories = $category->getAll();
});

$cancelOrder = function () {
    Cart::destroy();
    $this->dispatch('destroy_cart');
};

?>

<aside class="md:w-72">
    <div class="flex justify-center">
        <img class="block h-36 w-auto fill-current text-gray-800 dark:text-gray-200" src="{{ asset('/img/logo.png') }}"
            alt="logo" />
    </div>
    <div class="mt-2">
        @foreach ($categories as $category)
            <livewire:layout.sidebaritem :$category :key="$category->id" />
        @endforeach
    </div>

    <div class="my-5 px-5">
        <button wire:click='cancelOrder' type="button"
            class="w-full truncate rounded-md bg-red-base p-3 text-center font-bold text-rose-50">
            Cancelar Orden
        </button>
    </div>
</aside>
