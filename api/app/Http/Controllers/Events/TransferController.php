<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\Contracts\AccountServiceInterface;

class TransferController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function transfer(array $data): array
    {
        return $this->accountService->transfer($data);
    }
}
