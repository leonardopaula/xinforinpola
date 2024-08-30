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

    /**
     * Create a transactions without persist on database
     *
     * @param Wallet $walletPayer
     * @param Wallet $walletPayee
     * @param float $value
     * @return Transaction
     */
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

    /**
     * Fail transaction and persist
     *
     * @param ErrorCodes $errorCode
     * @return void
     */
    public function fail(ErrorCodes $errorCode)
    {
        $errorInfo = $errorCode->info();
        $this->transaction->success = false;
        $this->transaction->message = $errorInfo['message'];
        $this->transaction->save();
    }

    /**
     * Persist success transaction on database
     *
     * @return Transaction
     */
    public function success()
    {
        $this->transaction->success = true;
        $this->transaction->message = "Transaction successfully executed";
        $this->transaction->save();

        return $this->transaction;
    }
}
