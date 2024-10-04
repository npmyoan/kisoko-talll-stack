<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="w-100 flex justify-center">
        <div class="w-96 rounded-md shadow-sm">
            <div class="rounded-t-md bg-gray-300 px-4 py-2 text-xl font-bold text-red-base shadow-sm">
                Order {{ $order->id }}
            </div>
            @foreach ($order->products as $product)
                <div class="card-body px-4 py-2">
                    <article class="flex items-center justify-between gap-3 p-2">
                        <div class="flex items-center gap-4">
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
            @endforeach
            <div class="flex items-center justify-between">
                <span class="font-bold text-rose-900">Total: </span>
                <span class="p-4 text-rose-500"> {{ formatCurrency($order->total) }}</span>
            </div>
        </div>

    </div>
</body>

</html>
