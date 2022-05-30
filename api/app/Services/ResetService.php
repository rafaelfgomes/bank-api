<?php

namespace App\Services;

use App\Services\Contracts\ResetServiceContract;
use Illuminate\Support\Facades\DB;

class ResetService implements ResetServiceContract
{
    public function initApp(): void
    {
        DB::table('accounts')->truncate();
    }
}