<?php

use function Livewire\Volt\{state, computed};
use Gloudemans\Shoppingcart\Facades\Cart;

state(['product'])->reactive();
state(['qty' => 1]);

$addCart = function () {
    Cart::add(['id' => $this->product->id, 'name' => $this->product->name, 'qty' => $this->qty, 'price' => $this->product->price, 'weight' => 0, 'options' => ['image' => $this->product->image]]);
    $this->dispatch('addCart');
};

$price = computed(function () {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($this->product->price);
});

$incrementQty = function () {
    if ($this->qty == 5) {
        return;
    }
    $this->qty++;
};

$decrementQty = function () {
    if ($this->qty == 1) {
        return;
    }
    $this->qty--;
};
?>

<div x-data="{ open: false }" class="w-1/2">
    <button @click="open = true" type="button"
        class="font-sm mt-[-18px] flex items-center justify-center gap-2 rounded-3xl border border-rose-900 bg-rose-50 px-4 py-2 text-center font-bold text-rose-900 hover:border-red-base hover:text-red-base">

        <img src="{{ asset('/storage/icons/icon-add-to-cart.svg') }}" alt="agregar al carrito" class="h-5 w-5" />
        Agregar

    </button>

    @teleport('body')
        <div class="fixed left-0 top-0 grid h-screen w-screen w-screen place-items-center bg-transparent"x-show="open">
            <div class="gap-10 bg-white p-5 md:flex">
                <div class="md:w-1/3">
                    <img src="{{ asset('/storage/products/' . $product->image) . '.jpg' }}" alt="{{ $product->name }}" />
                </div>
                <div class="md:w-2/3">
                    <div class="flex justify-end">
                        <button @click="open = false" class="">
                            <img src="{{ 'storage/icons/icon-remove-item.svg' }}" alt="close"
                                class="h-4 w-4 rounded-full border border-slate-400">
                        </button>
                    </div>
                    <h1 class="mt-3 text-xl font-bold">
                        {{ $product->name }}
                    </h1>

                    <p class="mt-5 text-4xl font-black text-red-base">{{ $this->price }}</p>

                    <div class="mt-5 flex items-center gap-4">
                        <button wire:click='incrementQty'>
                            <svg class="h-4 w-4 rounded-full border border-slate-500 p-1" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 10">
                                <path fill="black"
                                    d="M10 4.375H5.625V0h-1.25v4.375H0v1.25h4.375V10h1.25V5.625H10v-1.25Z" />
                            </svg>
                        </button>
                        <p class="text-xl">{{ $qty }}</p>
                        <button wire:click="decrementQty">
                            <svg class="h-4 w-4 rounded-full border border-slate-500 p-1" xmlns="http://www.w3.org/2000/svg"
                                width="10" height="2" fill="black" viewBox="0 0 10 2">
                                <path d="M0 .375h10v1.25H0V.375Z" />
                            </svg>

                        </button>
                    </div>

                    <button type="button"
                        class="mt-5 rounded bg-red-base px-5 py-2 font-bold uppercase text-white hover:bg-red-700"
                        wire:click='addCart' @click="open = false">
                        Añadir al pedido
                    </button>
                </div>
            </div>
        </div>
    @endteleport

</div>

@script
    <script>
        $wire.on('addCart', () => {
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
                title: 'Se agregó el producto al carrito',
            })
        });
    </script>
@endscript
