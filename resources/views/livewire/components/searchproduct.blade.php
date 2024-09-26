<?php

use function Livewire\Volt\{state};

state(['search' => '']);

$onSearch = function () {
    $this->dispatch('search-products', search: $this->search);
};

?>

<div class="min-w-20 flex items-center">
    <input class="border-0 border-b placeholder:text-gray-300 focus:border-b focus:ring-0" type="text"
        placeholder="Buscar Producto" id="search" name="search" wire:model="search" wire:keypress="onSearch" />
</div>
