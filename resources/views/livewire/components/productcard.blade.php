<?php

use function Livewire\Volt\{state, computed, on};
use App\Constant;
use Gloudemans\Shoppingcart\Facades\Cart;
state(['product']);

$addCart = function () {
    Cart::add(['id' => $this->product['id'], 'name' => $this->product['name'], 'qty' => 1, 'price' => $this->product['price'], 'weight' => 0]);
    $this->dispatch('addCart');
};

$price = computed(function () {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($this->product['price']);
});
$urlProduct = computed(function () {
    return Constant::URL_STORAGE_PRODUCT . $this->product['image'] . '.jpg';
});

?>

<div class="border bg-white p-3 shadow">
    <img src="{{ asset($this->urlProduct) }}" alt="{{ $product['name'] }}" class="w-full" />
    <div class="p-5">
        <h3 class="text-2xl font-bold"> {{ $product['name'] }}</h3>
        <p class="mt-5 text-4xl font-black text-amber-500">
            {{ $this->price }}
        </p>

        <button wire:click='addCart' type="button"
            class="mt-5 w-full bg-indigo-600 p-3 font-bold uppercase text-white hover:bg-indigo-800">
            Agregar
        </button>
    </div>
</div>
