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
    <div class="p-4">
        <img class="w-32" src=" {{ asset('storage/img/logo.jpg') }} " alt="logo" />
    </div>
    <div class="mt-2">
        @foreach ($categories as $category)
            <livewire:layout.sidebaritem :$category :key="$category->id" />
        @endforeach
    </div>

    <div class="my-5 px-5">
        <button wire:click='cancelOrder' type="button"
            class="w-full truncate bg-red-base p-3 text-center font-bold text-rose-50">
            Cancelar Orden
        </button>
    </div>
</aside>
