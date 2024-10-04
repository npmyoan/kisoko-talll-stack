<?php

use App\Models\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderSended;
use function Livewire\Volt\{state, layout, mount};

layout('layouts.app');
state(['orders' => Order::where('status', 0)->with('user')->with('products')->get()]);

$completeOrder = function (int $orderId) {
    $order = Order::where('id', $orderId)->first();
    // $order->update(['status' => 1]);
    $order->user->notify(new OrderSended($order));
    // Mail::to($order->user->email)->send(new OrderShipped($order));
    $this->dispatch('completed-order');
};
?>

<div>

    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Administra tus ordenes aquí
        </h2>
    </x-slot:header>
    <div>
        <div class="grid auto-cols-[22rem] grid-flow-dense grid-cols-[repeat(auto-fill,_minmax(25rem,_1fr))] gap-5">
            @forelse ($orders as $order)
                <div class="rounded-md shadow-sm">
                    <div class="rounded-t-md bg-gray-300 px-4 py-2 text-xl font-bold text-red-base shadow-sm">
                        Order {{ $order->id }}
                    </div>
                    @forelse ($order->products as $product)
                        <div class="card-body px-4 py-2">
                            <article class="flex items-center justify-between gap-3 p-2">
                                <div class="flex items-center gap-4">
                                    <img class="h-20 w-20 rounded-lg"
                                        src="{{ asset('storage/products/' . $product->product->image . '.jpg') }}"
                                        -alt="{{ $product->product->name }}">
                                    <div class="flex flex-col gap-4">
                                        <h4 class="font-bold text-rose-900">{{ $product->product->name }}</h4>
                                        <div class="flex items-center justify-start gap-6">
                                            <p class="font-bold text-red-base">{{ $product->quantity }}x</p>
                                            <p><span>@ </span>{{ formatCurrency($product->price) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="font-bold text-rose-900">
                                    {{ formatCurrency($product->quantity * $product->price) }}
                                </p>

                            </article>
                        </div>

                    @empty
                        No hay productos
                    @endforelse

                    <p class="p-4 text-rose-500"> {{ formatCurrency($order->total) }}</p>

                    <button wire:click='completeOrder({{ $order->id }})'
                        class="w-full bg-red-base px-2 py-3 text-center font-bold uppercase text-white transition-colors hover:bg-rose-800">Completar</button>

                </div>
            @empty
                <p class="text-xl font-bold">No hay Ordenes para completar</p>
            @endforelse
        </div>
    </div>
</div>


@script
    <script>
        $wire.on('completed-order', () => {
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
                title: 'Se completo la orden',
            })
        });
    </script>
@endscript
