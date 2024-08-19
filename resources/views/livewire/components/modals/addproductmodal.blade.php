<?php

use function Livewire\Volt\{state};

state(['product'])->reactive();
state(['quantity' => 1]);

?>


<article class="gap-10 md:flex">
    <div class="md:w-1/3">
        <img src="{{ 'storage/product/' . product->image }}" alt="Imagen del producto {{ product->image }}">
    </div>
    <div class="md:w-2/3">
        <div class="flex justify-end">
            <img class="h-4 w-4 cursor-pointer rounded-3xl border border-slate-300"
                src="{{ 'storage/icons/icon-remove-item.svg' }}" alt="">
        </div>
        <h2 class="mt-5 text-3xl font-bold">
            {{ product->name }}
        </h2>
        <p class="mt-5 text-5xl font-black text-red-base">
            {{ product->price }}
        </p>

        <div class="mt-5 flex gap-4">
            <button class="h-4 w-4 rounded-full border border-slate-100 p-0.5">
                <img src="{{ asset('storage/icons/icon-decrement-quantity.svg') }}" alt="eliminar producto">
            </button>

            <p class="text-3xl">{{ quantity }}</p>
            <button class="h-4 w-4 rounded-full border border-slate-100 p-0.5">
                <img src="{{ asset('storage/icons/icon-increment-quantity.svg') }}" alt="incrementar producto">
            </button>
        </div>

        <button class="mt-5 rounded bg-rose-400 px-5 py-2 font-bold uppercase text-white hover:bg-rose-500"
            type="button">
            Añadir al pedido
        </button>
    </div>
</article>
