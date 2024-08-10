<?php

use function Livewire\Volt\{state, on};
use Gloudemans\Shoppingcart\Facades\Cart;

on(['addCart']);
on(['destroy_cart']);

?>

<div class="bg-rose-100 p-4 md:w-72">
    <div class="min-h-72 rounded-md bg-white p-2">
        <h2 class="mb-2 text-3xl font-bold text-red-base">Tu Carrito ({{ Cart::count() }})</h2>
        @if (Cart::count() == 0)
            <div class="mt-2 flex flex-col items-center justify-center">
                <img class="mb-3" src="{{ asset('storage/icons/illustration-empty-cart.svg') }}" alt="carrito vácio">
                <p class="text-center text-rose-300">Los elementos que hayas añadido aparecerán aquí.</p>
            </div>
        @else
            <div>
                @foreach (Cart::content() as $product)
                    <article class="shadow">
                        <div class="p-2">
                            <p class="text-sm">{{ $product->name }}</p>
                            <div class="flex items-center justify-start gap-6">
                                <p class="font-bold text-red-base">{{ $product->qty }}x</p>
                                <p><span>@</span>{{ $product->price }}</p>
                                <p><span>@</span>{{ $product->qty * $product->price }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2">
                            <div class="flex h-7 w-6/12 items-center justify-between rounded-3xl bg-red-base p-2">
                                <button class="h-4 w-4 rounded-full border border-slate-100 p-0.5">
                                    <img src="{{ asset('storage/icons/icon-decrement-quantity.svg') }}"
                                        alt="eliminar producto">
                                </button>
                                <button class="h-4 w-4 rounded-full border border-slate-100 p-0.5">
                                    <img src="{{ asset('storage/icons/icon-increment-quantity.svg') }}"
                                        alt="eliminar producto">
                                </button>
                            </div>
                            <button class="h-4 w-4 rounded-full border border-slate-500 p-0.5">
                                <img src="{{ asset('storage/icons/icon-remove-item.svg') }}" alt="eliminar producto">
                            </button>
                        </div>
                    </article>
                    {{-- <livewire:components.product-cart :$product :key="$product->rowId"> --}}
                @endforeach

                {{-- <p>SubTotal: ${{ Cart::subtotal() }}</p>
                <p>Domicilio: ${{ Cart::tax() }}</p>
                <p>Total ${{ Cart::total() }}</p>
                {{ Cart::priceTotal() }} --}}
            </div>
        @endif

    </div>
</div>
