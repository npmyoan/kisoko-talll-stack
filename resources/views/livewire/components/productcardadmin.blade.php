<?php

use function Livewire\Volt\{state, computed, on};
use App\Constant;

use App\Business\IProductRepository;

state(['product']);

$price = computed(function () {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($this->product->price);
});
$urlProduct = computed(function () {
    return Constant::URL_STORAGE_PRODUCT . $this->product->image . '.jpg';
});

$updateIsAvailable = function (IProductRepository $products) {
    $product = $products->available($this->product->id);
    $this->dispatch('is-stock', product: $product);
};

?>


<div class="rounded-[2rem] border shadow">

    <div class="flex flex-col items-center justify-center rounded-[2rem]">
        <img src="{{ asset($this->urlProduct) }}" alt="{{ $product->name }}" class="w-full rounded-[2rem]" />
    </div>
    <div class="p-5">
        <p class="text-slate-400">{{ $product->category->name }}</p>
        <h3 class="text-2xl"> {{ $product->name }}</h3>

        <p class="mt-2 text-xl font-black text-red-base">
            {{ $this->price }}
        </p>

        <button class="mt-3 w-full rounded bg-red-base py-2 font-bold uppercase text-white hover:bg-rose-800"
            wire:click='updateIsAvailable'>
            @if ($product->available)
                product agotado
            @else
                agregar
            @endif

        </button>
    </div>
</div>


@script
    <script>
        $wire.on('is-stock', ($product) => {

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


            if (!$product.product.available) {
                Toast.fire({
                    icon: 'success',
                    title: 'Producto agotado',
                })
                return
            }

            Toast.fire({
                icon: 'success',
                title: 'Producto disponible',
            })

        });
    </script>
@endscript
