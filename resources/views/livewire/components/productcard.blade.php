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

<div class="rounded-[2rem] border bg-white shadow">
    <div class="flex flex-col items-center justify-center rounded-[2rem]">
        <img src="{{ asset($this->urlProduct) }}" alt="{{ $product['name'] }}" class="w-full rounded-[2rem]" />
        <button wire:click='addCart' type="button"
            class="font-sm mt-[-18px] flex w-1/2 items-center justify-center gap-2 rounded-3xl border border-rose-900 bg-rose-50 px-4 py-2 text-center font-bold text-rose-900 hover:border-red-base hover:text-red-base">

            <img src="{{ asset('/storage/icons/icon-add-to-cart.svg') }}" alt="agregar al carrito" class="h-5 w-5" />
            Agregar

        </button>
    </div>
    <div class="p-5">
        <p class="text-slate-400">{{ $product->category->name }}</p>
        <h3 class="text-2xl"> {{ $product['name'] }}</h3>

        <p class="mt-2 text-xl font-black text-red-base">
            {{ $this->price }}
        </p>


    </div>
</div>
