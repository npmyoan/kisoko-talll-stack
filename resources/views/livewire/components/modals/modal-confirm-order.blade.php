<?php

use function Livewire\Volt\{state, computed, on};
use Gloudemans\Shoppingcart\Facades\Cart;

on(['addCart']);
on(['destroy_cart']);

$confirmOrder = function () {
    Cart::destroy();
    $this->dispatch('destroy_cart');
};
?>



<div x-data="{ open: false }" class="w-full">
    <button class="w-full rounded-3xl bg-red-base px-2 py-3 text-white transition-colors hover:bg-red-700"
        @click="open = true">Confirmar
        la
        orden</button>

    @teleport('body')
        <div class="fixed left-0 top-0 grid h-screen w-screen w-screen place-items-center bg-transparent" x-show="open">
            <div class="scroll-bg h-screen w-4/12 overflow-y-scroll rounded-lg bg-white p-10">
                <img src="{{ asset('storage/icons/icon-order-confirmed.svg') }}" alt="Confirmación del la orden">
                <h3 class="mt-6 text-3xl font-black text-rose-900">Confirma la orden</h3>
                <p class="text-rose-400">¡Esperamos que disfrutes tu comida!</p>
                <section class="mt-4 bg-rose-100">
                    @foreach (Cart::content() as $product)
                        <article class="flex gap-3 p-4">
                            <img class="h-20 w-20 rounded-lg"
                                src="{{ asset('storage/products/' . $product->options->image . '.jpg') }}"
                                alt="{{ $product->name }}">
                            <h4 class="font-bold text-rose-900">{{ $product->name }}</h4>
                        </article>
                        <hr />
                    @endforeach
                    <article class="flex gap-3 p-4">
                        <p class="text-rose-500">Total de la Orden</p>
                        <p class="text-xl font-bold text-rose-900">{{ $product->price }}</p>
                    </article>
                </section>
                <button type="button"
                    class="mt-5 w-full rounded-3xl bg-red-base px-5 py-2 font-bold uppercase text-white hover:bg-red-700"
                    wire:click='confirmOrder' @click="open = false">
                    Iniciar nuevo pedido
                </button>

            </div>
        </div>
    @endteleport

</div>

@script
    //
    <script>
        //     $wire.on('addCart', () => {
        //         const Toast = Swal.mixin({
        //             toast: true,
        //             position: 'top-end',
        //             iconColor: 'white',
        //             customClass: {
        //                 popup: 'colored-toast',
        //             },
        //             showConfirmButton: false,
        //             timer: 1500,
        //             timerProgressBar: true,
        //         })

        //         Toast.fire({
        //             icon: 'success',
        //             title: 'Se agregó el producto al carrito',
        //         })
        //     });
        //
    </script>
@endscript
