<?php

namespace App\Repositories;

interface UserRepository
{
    public function index();

    public function store(array $data);

    public function show(int|string $id);

    public function update(array $data, int|string $id);

    public function destroy(int|string $id);
}
