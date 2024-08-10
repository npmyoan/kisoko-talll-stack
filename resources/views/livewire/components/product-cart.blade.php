<?php

use function Livewire\Volt\{state};

state(['product']);

$price = computed(function () {
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->format($this->product->price);
});

?>

<div>
    <p class="text-lg">{{ 0 }}</p>
</div>
