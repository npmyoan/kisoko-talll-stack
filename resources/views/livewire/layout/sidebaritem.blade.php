<?php

use function Livewire\Volt\{state, computed};
use App\Constant;

state(['category']);

$urlIcon = computed(function () {
    return Constant::URL_STORAGE_ICON . $this->category->icon . '.svg';
});

?>

<div>
    <a href='{{ route('home.category', ['category' => $category->slug]) }}'
        class="flex w-full cursor-pointer items-center gap-4 border p-3 hover:bg-rose-500 hover:text-white"
        wire:navigate>
        <img class="w-12" src="{{ asset($this->urlIcon) }}" alt="Icono" />
        <p class="cursor-pointer truncate text-lg font-bold">{{ $category->name }}</p>
    </a>
</div>
