<?php

use function Livewire\Volt\{state, mount, layout, on};
use App\Livewire\Actions\Logout;

use App\Business\IProductRepository;
use App\Business\ICategoryRepository;
use App\Models\Product;

layout('layouts.default');

state([
    'products' => [],
    'categoryName' => 'Todos los productos',
]);

state(['category'])->url();

mount(function (IProductRepository $product, ICategoryRepository $categoryRepository) {
    if (!$this->category) {
        $this->products = $product->getAll();
        $this->categoryName = 'Todos los productos';
    } else {
        $this->categoryName = $categoryRepository->getBySlug($this->category)->name;
        $this->products = $product->getByCategory($this->category);
    }
});

$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};

?>

<div class="relative">
    <div class="cursor-pointer" wire:click='logout'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-10 absolute right-3 top-4 transition-colors hover:text-red-500 active:scale-90">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
        </svg>
    </div>

    <h1 class="text-4xl font-black">{{ $categoryName }}</h1>
    <p class="my-4 text-2xl">Elige y perzonaliza tu pedido a continuación</p>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <livewire:components.productcard :$product :key="$product->id" />
        @empty
            No hay Productos
        @endforelse
    </div>
</div>
