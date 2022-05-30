<?php

namespace App\Http\Controllers\Events;

use App\Services\AccountService;
use App\Http\Controllers\Controller;
use App\Services\Contracts\AccountServiceInterface;

class DepositController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function deposit(array $data): array
    {
        return $this->accountService->deposit($data);
    }
}
