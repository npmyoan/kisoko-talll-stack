<?php

use function Livewire\Volt\{state, on};
use Gloudemans\Shoppingcart\Facades\Cart;

on(['addCart']);
on(['destroy_cart']);
on([
    'save_order' => function () {
        Cart::destroy();
    },
]);

$addQty = fn($rowId, $quantity) => Cart::update($rowId, $quantity + 1);
$subtractQty = fn($rowId, $quantity) => Cart::update($rowId, $quantity - 1);
$removeProduct = fn($rowId) => Cart::remove($rowId);

$priceHumanization = function (float $price) {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($price);
};

?>

<div class="bg-rose-100 p-4 md:w-72">
    <div class="min-h-72 rounded-md bg-white p-2">
        <h2 class="mb-2 text-3xl font-black text-red-base">Tu Carrito ({{ Cart::count() }})</h2>
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
                                <p><span>@ </span>{{ $this->priceHumanization($product->price) }}</p>
                                <p><span></span>{{ $this->priceHumanization($product->qty * $product->price) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2">
                            <div class="flex h-7 w-6/12 items-center justify-between rounded-3xl bg-red-base p-2">
                                <button class="h-4 w-4 rounded-full border border-slate-100 p-0.5"
                                    wire:click="subtractQty('{{ $product->rowId }}', {{ $product->qty }})">
                                    <img src="{{ asset('storage/icons/icon-decrement-quantity.svg') }}"
                                        alt="eliminar producto">
                                </button>
                                <button class="h-4 w-4 rounded-full border border-slate-100 p-0.5"
                                    wire:click="addQty('{{ $product->rowId }}', {{ $product->qty }})">
                                    <img src="{{ asset('storage/icons/icon-increment-quantity.svg') }}"
                                        alt="incrementar producto">
                                </button>
                            </div>
                            <button class="h-4 w-4 rounded-full border border-slate-500 p-0.5"
                                wire:click="removeProduct('{{ $product->rowId }}')">

                                <img src="{{ asset('storage/icons/icon-remove-item.svg') }}" alt="eliminar producto">
                            </button>
                        </div>
                    </article>
                @endforeach
                <hr class="mt-4 shadow" />
                <div class="flex items-center justify-between px-2 py-4">
                    <p>Total a Pagar: </p>
                    <p class="mt-2 text-xl font-black">${{ Cart::subtotal() }}</p>
                </div>
                <livewire:components.modals.modal-confirm-order />
            </div>
        @endif

    </div>
</div>
