<?php

use function Livewire\Volt\{state, layout, rules, usesFileUploads, mount};
use App\Business\IProductRepository;
use App\Business\ICategoryRepository;
use App\Models\Product;

usesFileUploads();

layout('layouts.app');

state([
    'name' => '',
    'price' => 0,
    'category_id' => '',
]);

state(['image']);
state(['categories' => []]);

mount(function (ICategoryRepository $category) {
    $this->categories = $category->getAll();
});

rules([
    'name' => 'required|max:30',
    'price' => 'required|numeric|gte:1',
    'image' => 'required|image|max:2048',
    'category_id' => 'required',
])->messages([
    'name.required' => 'El nombre es obligatorio',
    'name.max' => 'El nombre debe tener un máximo de 30 carácteres',
    'price.required' => 'El precio es obligatorio',
    'price.numeric' => 'El precio debe ser un número',
    'price.gte' => 'El precio debe ser mayor que 0',
    'image.required' => 'La imagen es obligatoria',
    'image.image' => 'La imagen debe ser un archivo válido',
]);

$login = function (IProductRepository $product) {
    $this->validate();
    $image = $this->image->store('public/products');
    $imgArr = explode('/', $image)[2];
    $productImage = explode('.', $imgArr)[0];

    $productSave = new Product();
    $productSave->name = $this->name;
    $productSave->price = $this->price;
    $productSave->category_id = $this->category_id;
    $productSave->image = $productImage;

    $product->create($productSave);

    $this->redirect(route('admin.products'), navigate: true);
    $this->dispatch('save_product');
};

?>

<div class="flex h-full w-full items-center justify-center">
    <div class="min-w-96 rounded-md bg-white p-10 shadow">
        <form wire:submit="login">

            <div>
                <x-input-label for="name" value="Nombre" />
                <x-text-input wire:model="name" class="mt-1 block w-full" type="text" id="name" name="name"
                    autofocus autocomplete="name" />


                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="price" value="Precio" />

                <x-text-input wire:model="price" id="price" class="mt-1 block w-full" type="number" name="price"
                    autocomplete="number" />

                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="image" value="Imagen" />
                {{-- <img src="{{ $image }}" alt=""> --}}
                <input type="file" id="image" name="image" wire:model="image" />

                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="category" value="Precio" />
                <select wire:model='category_id' id="category" name="category">
                    <option>--Selecione una categoria--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>

                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <x-primary-button class="ms-3">
                    Guardar
                </x-primary-button>
            </div>
        </form>

    </div>
</div>


@script
    <script>
        $wire.on('save_product', () => {
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
                title: 'Se creó el producto',
            })
        });
    </script>
@endscript
