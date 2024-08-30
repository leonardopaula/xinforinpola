<?php

namespace App\Repositories\Wallet;

interface WalletRepositoryInterface
{
    public function getWallet(int $userId, $lock = false);
}
