<?php

use App\Http\Middleware\RoleVerified;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::redirect('/', 'home', 301);

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('home', 'pages.home')
        ->name('default');
    Volt::route('admin', 'pages.admin.orders')
        ->name('admin')->middleware(['isAdmin']);
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
