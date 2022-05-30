<?php

namespace App\Repositories\Contracts;

use App\Models\Account;

interface AccountRepositoryInterface
{
    public function search(int $id): ?Account;
    public function store(array $data): Account;
    public function deposit(array $data): ?Account;
    public function withdraw(array $data): ?Account;
    public function transfer(array $data): ?array;
}