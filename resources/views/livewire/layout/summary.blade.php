<?php

use function Livewire\Volt\{state, on};
use Gloudemans\Shoppingcart\Facades\Cart;

on(['addCart']);
on(['destroy_cart']);

?>

<div class="md:w-72">
    <h1>Summary</h1>
    {{ Cart::content() }}
</div>
