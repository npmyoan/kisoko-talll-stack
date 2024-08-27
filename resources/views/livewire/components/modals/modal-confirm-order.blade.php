<?php

use function Livewire\Volt\{state, computed, on};
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderProduct;

on(['addCart']);
on(['destroy_cart']);

$confirmOrder = function () {
    $order = auth()
        ->user()
        ->orders()
        ->create([
            'total' => Cart::subtotal(),
        ]);

    Cart::content()->each(function ($product) use ($order) {
        OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'quantity' => $product->qty,
        ]);
    });
    $this->dispatch('save_order');
};

$priceHumanization = function (float $price) {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($price);
};
?>



<div x-data="{ open: false }" class="w-full">
    <button class="w-full rounded-3xl bg-red-base px-2 py-3 text-white transition-colors hover:bg-red-700"
        @click="open = true">Confirmar
        la
        orden</button>

    @teleport('body')
        <div class="fixed left-0 top-0 grid h-screen w-screen place-items-center bg-transparent" x-show="open">
            <div class="scroll-bg h-screen w-5/12 overflow-y-scroll rounded-lg bg-white p-10">
                <img src="{{ asset('storage/icons/icon-order-confirmed.svg') }}" alt="Confirmación del la orden">
                <h3 class="mt-6 text-3xl font-black text-rose-900">Confirma la orden</h3>
                <p class="text-rose-400">¡Esperamos que disfrutes tu comida!</p>
                <section class="mt-4 rounded-md bg-rose-100">
                    @if (Cart::count() > 0)
                        @foreach (Cart::content() as $product)
                            <article class="flex items-center justify-between gap-3 p-4">
                                <div class="flex items-center gap-4">
                                    <img class="h-20 w-20 rounded-lg"
                                        src="{{ asset('storage/products/' . $product->options->image . '.jpg') }}"
                                        alt="{{ $product->name }}">
                                    <div class="flex flex-col gap-4">
                                        <h4 class="font-bold text-rose-900">{{ $product->name }}</h4>
                                        <div class="flex items-center justify-start gap-6">
                                            <p class="font-bold text-red-base">{{ $product->qty }}x</p>
                                            <p><span>@ </span>{{ $this->priceHumanization($product->price) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="font-bold text-rose-900">
                                    <span></span>{{ $this->priceHumanization($product->qty * $product->price) }}
                                </p>
                            </article>
                            <hr />
                        @endforeach
                    @endif
                    <article class="flex justify-between gap-3 p-4">
                        <p class="font-bold text-rose-500">Total de la Orden</p>
                        <p class="text-xl font-black text-rose-900">{{ $this->priceHumanization(Cart::subtotal()) }}</p>
                    </article>
                </section>
                <button type="button"
                    class="mt-5 w-full rounded-3xl bg-red-base px-5 py-2 font-bold uppercase text-white hover:bg-red-700"
                    @click="open = false" wire:click='confirmOrder'>
                    Iniciar nuevo pedido
                </button>

            </div>
        </div>
    @endteleport

</div>

@script
    <script>
        $wire.on('save_order', () => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'success',
                title: 'Se envió la orden',
            })
        });
    </script>
@endscript
