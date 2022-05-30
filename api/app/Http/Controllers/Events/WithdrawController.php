<?php

namespace App\Http\Controllers\Events;

use App\Controllers\Contracts\WithdrawControllerInterface;
use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\Contracts\AccountServiceInterface;

class WithdrawController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function withdraw(array $data): ?array
    {
        return $this->accountService->withdraw($data);
    }
}
