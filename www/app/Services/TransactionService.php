<?php

namespace App\Services;

use App\Enums\ErrorCodes;
use App\Exceptions\TransferException;
use App\Jobs\TransferNotifyJob;
use App\Models\User;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Wallet\WalletRepository;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    private $transactionRepository;
    private $walletRepository;

    public function __construct(TransactionRepository $transactionRepository, WalletRepository $walletRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
    }

    public function executeTransaction(User $payer, User $payee, float $value)
    {
        $error = null;
        DB::transaction(function () use ($payer, $payee, $value, &$error) {
            $payerWallet = $this->walletRepository->getWallet($payer->id, true);
            $payeeWallet = $this->walletRepository->getWallet($payee->id, true);

            $this->transactionRepository->create($payerWallet, $payeeWallet, $value);

            if (empty($payerWallet)) {
                $this->transactionRepository->fail(ErrorCodes::TRANSACTION_PAYER_WALLET_NOT_FOUND);
                $error = ErrorCodes::TRANSACTION_PAYER_WALLET_NOT_FOUND;
            }

            if (empty($payeeWallet)) {
                $this->transactionRepository->fail(ErrorCodes::TRANSACTION_PAYEE_WALLET_NOT_FOUND);
                $error = ErrorCodes::TRANSACTION_PAYEE_WALLET_NOT_FOUND;
            }

            if ($value > $payerWallet->balance) {
                $this->transactionRepository->fail(ErrorCodes::TRANSACTION_INSUFFICIENT_BALANCE);
                $error = ErrorCodes::TRANSACTION_INSUFFICIENT_BALANCE;
            }

            if ($error === null) {
                $payerWallet->balance = $payerWallet->balance - $value;
                $payerWallet->save();

                $payeeWallet->balance = $payeeWallet->balance + $value;
                $payeeWallet->save();
                $transaction = $this->transactionRepository->success();

                TransferNotifyJob::dispatch($transaction);
            }
        });

        if ($error) {
            throw new TransferException($error);
        }

        return true;
    }
}
