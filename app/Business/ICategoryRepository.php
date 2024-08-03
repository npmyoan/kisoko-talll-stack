<?php

namespace App\Business;

use Illuminate\Support\Collection;

interface ICategoryRepository
{
    public function getAll(): Collection;

    public function getById(int $id): object;

    public function save(object $category): object;

    public function destroyById(int $id): void;
}
