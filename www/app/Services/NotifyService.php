<?php

namespace App\Services;

use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotifyService
{

    /**
     * Try o notify payee
     *
     * @param Transaction $transaction
     * @return void
     */
    public function notifyTransfer(Transaction $transaction)
    {
        try {
            $request = Http::acceptJson()
                ->post(config('transfer.transaction_notify'));

            $request->throw();

            if ($request->successful()) {
                Log::notice("Notified user - transaction: " . $transaction->id);
                return true;
            }
        } catch (Exception $e) {
            Log::warning("Failed to notify - transaction: " . $transaction->id . " - " . $e->getMessage());
            throw $e;
        }
    }
}
