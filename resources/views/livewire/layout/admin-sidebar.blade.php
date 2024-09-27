<?php
use function Livewire\Volt\{state};

?>

<aside class="h-screen bg-gray-100 md:w-72">
    <div class="p-4">
        <img class="block h-36 w-auto fill-current text-gray-800 dark:text-gray-200" src="{{ asset('/img/logo.png') }}"
            alt="logo" />
    </div>
    <nav class="flex flex-col p-4">
        <a href="/admin" class="text-lg font-bold">Ordenes</a>
        <a href="/admin/products" class="text-lg font-bold">Productos</a>
    </nav>
</aside>
