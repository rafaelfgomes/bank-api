<?php

namespace App\Services\Contracts;

interface AccountServiceInterface
{
    public function search(int $id): ?array;
    public function store(array $data): array;
    public function deposit(array $data): array;
    public function withdraw(array $data): ?array;
    public function transfer(array $data): array;
}