<?php

use function Livewire\Volt\{state, on};
use Gloudemans\Shoppingcart\Facades\Cart;

on(['addCart']);
on(['destroy_cart']);

?>

<div class="md:w-72">
    <h1>Summary</h1>


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
