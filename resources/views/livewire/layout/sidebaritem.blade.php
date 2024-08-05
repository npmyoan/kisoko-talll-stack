<?php

use function Livewire\Volt\{state, computed};
use App\Constant;
use App\Business\IProductRepository;

state(['category']);
$urlIcon = computed(function () {
    return Constant::URL_STORAGE_ICON . $this->category->icon . '.svg';
});

$filterProducts = function (IProductRepository $product) {
    $products = $product->getByCategory($this->category->id);
    $this->dispatch('filter-products', products: $products);
};

?>

<div>
    <button wire:click='filterProducts'
        class="flex w-full cursor-pointer items-center gap-4 border p-3 hover:bg-amber-500">
        <img class="w-12" src="{{ asset($this->urlIcon) }}" alt="Icono" />
        <p class="cursor-pointer truncate text-lg font-bold">{{ $category->name }}</p>
    </button>
</div>
