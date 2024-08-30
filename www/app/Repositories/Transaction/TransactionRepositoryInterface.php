<?php

namespace App\Repositories\Transaction;

use App\Enums\ErrorCodes;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;

interface TransactionRepositoryInterface
{
    public function create(Wallet $walletPayer, Wallet $walletPayee, float $value): Transaction;
    public function success();
    public function fail(ErrorCodes $erroCodes);
}
