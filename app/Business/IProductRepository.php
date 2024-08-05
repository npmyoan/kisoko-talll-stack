<?php

namespace App\Business;

use Illuminate\Support\Collection;

interface IProductRepository
{
    public function getAll(): Collection;

    public function getByCategory(int $id): Collection;

    public function getById(int $id): object;

    public function create(object $product): object;

    public function update(object $product): int;

    public function destroyById(int $id): void;
}
