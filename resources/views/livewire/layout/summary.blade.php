<?php

use function Livewire\Volt\{state, on};
use Gloudemans\Shoppingcart\Facades\Cart;

on(['addCart']);
on(['destroy_cart']);

?>

<div class="bg-rose-100 p-4 md:w-72">
    <div class="min-h-72 rounded-md bg-white p-2">
        <h2 class="text-3xl font-bold text-red-base">Tu Carrito ({{ Cart::count() }})</h2>
        @if (Cart::count() == 0)
            <div class="mt-2 flex flex-col items-center justify-center">
                <img class="mb-3" src="{{ asset('storage/icons/illustration-empty-cart.svg') }}" alt="carrito vácio">
                <p class="text-center text-rose-300">Los elementos que hayas añadido aparecerán aquí.</p>
            </div>
        @else
            <div>
                @forelse (Cart::content() as $product)
                    <li>{{ $product->id }}</li>
                @empty
                    <p>Agregue productos al carrito</p>
                @endforelse

                <p>SubTotal: ${{ Cart::subtotal() }}</p>
                <p>Domicilio: ${{ Cart::tax() }}</p>
                <p>Total ${{ Cart::total() }}</p>
                {{ Cart::priceTotal() }}
            </div>
        @endif

    </div>
</div>
