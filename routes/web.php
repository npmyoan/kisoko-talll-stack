<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::redirect('/', 'home', 301);

Route::middleware(['auth', 'verified'])->group(function () {

    Volt::route('home', 'pages.home')
        ->name('default');

    Volt::route('home/{category}', 'pages.home')
        ->name('home.category');

    Volt::route('admin', 'pages.admin.orders')
        ->name('admin')->middleware(['isAdmin']);

    Volt::route('admin/products', 'pages.admin.products')
        ->name('admin.products')->middleware(['isAdmin']);

    Volt::route('admin/products/create', 'pages.admin.create-product')
        ->name('admin.products.create')->middleware(['isAdmin']);

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
