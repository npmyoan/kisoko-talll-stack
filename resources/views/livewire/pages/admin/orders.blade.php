<?php

use function Livewire\Volt\{state, layout, mount};
use App\Models\Order;

layout('layouts.app');
state(['orders' => []]);
mount(function () {
    $this->orders = Order::where('status', 0)->with('user')->with('products')->get();
});
?>

<div>

    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Administra tus ordenes aquí
        </h2>
    </x-slot:header>
    <div>
        <h2 class="my-10 text-2xl"></h2>
        <pre>
            {{ $orders }}
        </pre>
    </div>
</div>
