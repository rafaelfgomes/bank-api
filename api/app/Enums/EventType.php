<?php

namespace App\Enums;

class EventType
{
    public const DEPOSIT = 'deposit';
    public const WITHDRAW = 'withdraw';
    public const TRANSFER = 'transfer';

    public const VALUES = [
        self::DEPOSIT,
        self::WITHDRAW,
        self::TRANSFER
    ];
}