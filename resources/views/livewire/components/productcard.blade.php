<?php

use function Livewire\Volt\{state, computed, on};
use App\Constant;

state(['product']);

$productCollect = computed(fn() => collect($this->product));

$price = computed(function () {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($this->product->price);
});
$urlProduct = computed(function () {
    return Constant::URL_STORAGE_PRODUCT . $this->product->image . '.jpg';
});

?>



<div class="rounded-[2rem] border shadow">

    <div class="flex flex-col items-center justify-center rounded-[2rem]">
        <img src="{{ asset($this->urlProduct) }}" alt="{{ $product->name }}" class="w-full rounded-[2rem]" />
        <livewire:components.modals.modal-add-cart :$product />
    </div>
    <div class="p-5">
        <p class="text-slate-400">{{ $product->category->name }}</p>
        <h3 class="text-2xl"> {{ $product->name }}</h3>

        <p class="mt-2 text-xl font-black text-red-base">
            {{ $this->price }}
        </p>


    </div>
</div>
