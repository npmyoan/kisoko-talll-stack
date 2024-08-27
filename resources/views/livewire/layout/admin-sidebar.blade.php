<?php

use function Livewire\Volt\{state};

?>

<aside class="h-screen bg-gray-100 md:w-72">
    <div class="p-4">
        <img class="w-40" src=" {{ asset('storage/img/logo.jpg') }} " alt="logo" />
    </div>
    <nav class="flex flex-col p-4">
        <a href="/admin" class="text-lg font-bold">Ordenes</a>
        <a href="/admin/products" class="text-lg font-bold">Productos</a>
        {{-- @foreach ($categories as $category)
            <livewire:layout.sidebaritem :$category :key="$category->id" />
        @endforeach --}}
    </nav>

    {{-- <div class="my-5 px-5">
        <button wire:click='cancelOrder' type="button"
            class="w-full truncate bg-red-base p-3 text-center font-bold text-rose-50">
            Cancelar Orden
        </button>
    </div> --}}
</aside>
