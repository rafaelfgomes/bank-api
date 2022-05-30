<?php

namespace App\Services;

use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Services\Contracts\AccountServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountService implements AccountServiceInterface
{
    private $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function search(int $id): ?array
    {
        $account = $this->accountRepository->search((int) $id);

        if (empty($account)) {
            throw new ModelNotFoundException();
        }

        return ($this->accountRepository->search((int) $id))->toArray();
    }

    public function store(array $data): array
    {
        return ($this->accountRepository->store($data))->toArray();
    }

    public function deposit(array $data): array
    {
        $account = $this->accountRepository->deposit($data);

        if (empty($account)) {
            throw new ModelNotFoundException();
        }

        return $account->toArray();
    }

    public function withdraw(array $data): ?array
    {
        $account = $this->accountRepository->withdraw($data);

        if (empty($account)) {
            throw new ModelNotFoundException();
        }

        return $account->toArray();
    }

    public function transfer(array $data): array
    {
        $accounts = $this->accountRepository->transfer($data);
        
        if (empty($accounts)) {
            throw new ModelNotFoundException();
        }
        
        return $accounts;
    }
}