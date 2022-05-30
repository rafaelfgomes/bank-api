<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountRepository implements AccountRepositoryInterface
{
    private Account $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function search(int $id): ?Account
    {
        return $this->account->where('account_id', (int) $id)->first();
    }

    public function store(array $data): Account
    {
        $values = [
            'account_id' => (int) $data['destination'],
            'balance' => floatval($data['amount'])
        ];

        return $this->account->create($values);
    }

    public function deposit(array $data): ?Account
    {
        $account = $this->search((int) $data['destination']);

        if (empty($account)) {
            return $this->store($data);
        }

        $values = [
            'balance' => $account->balance + floatval($data['amount'])
        ];

        return tap($account)->update($values);
    }

    public function withdraw(array $data): ?Account
    {
        $account = $this->search((int) $data['origin']);

        if (!$account) {
            return null;
        }

        $values = [
            'balance' => $account->balance - floatval($data['amount'])
        ];

        return tap($account)->update($values);
    }

    public function transfer(array $data): ?array
    {
        $accountFrom = $this->search((int) $data['origin']);

        if (!$accountFrom) {
            return null;
        }

        $accountOrigin = $this->withdraw($data);

        $accountDestination = $this->deposit($data);

        return [
            'origin' => $accountOrigin->toArray(),
            'destination' => $accountDestination->toArray()
        ];
    }
}