<?php

namespace App\Repositories\Wallet;

use App\Models\Wallet;

class WalletRepository implements WalletRepositoryInterface
{
    protected $wallet;

    public function __construct(Wallet $model)
    {
        $this->wallet = $model;
    }

    public function getWallet(int $userId, $lock = false)
    {
        $balanceQuery = $this->wallet->where('user_id', $userId);

        if ($lock) {
            $balanceQuery->lockForUpdate();
        }

        return $balanceQuery->first();
    }
}
