<?php

use function Livewire\Volt\{state, layout};

state(['user' => 'user']);
layout('layouts.app');
?>

<div>

    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Orders
        </h2>
    </x-slot:header>
    <div>
        <h1>{{ $user }}</h1>
    </div>
</div>
