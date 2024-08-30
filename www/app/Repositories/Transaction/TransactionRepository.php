<?php

namespace App\Repositories\Transaction;

use App\Enums\ErrorCodes;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\Wallet\WalletRepository;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function create(Wallet $walletPayer, Wallet $walletPayee, float $value): Transaction
    {
        $this->transaction->fill([
            'payer_id' => $walletPayer->id,
            'payer_balance' => $walletPayer->balance,
            'payee_id' => $walletPayee->id,
            'payee_balance' => $walletPayee->balance,
            'value' => $value,
        ]);

        return $this->transaction;
    }

    public function fail(ErrorCodes $errorCode)
    {

        $errorInfo = $errorCode->info();
        $this->transaction->success = false;
        $this->transaction->message = $errorInfo['message'];
        $this->transaction->save();
    }

    public function success()
    {
        $this->transaction->success = true;
        $this->transaction->message = "Transaction successfully executed";
        $this->transaction->save();

        return $this->transaction;
    }
}
