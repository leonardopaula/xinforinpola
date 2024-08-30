<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\NotifyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var integer
     */
    public $tries = 5;

    /**
     * Transaction with date to notify
     *
     * @var Transaction
     */
    private Transaction $transaction;

    /**
     * Create job instance
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @param NotifyService $notifyService
     * @return void
     */
    public function handle(NotifyService $notifyService): void
    {
        $notifyService->notifyTransfer($this->transaction);
    }
}
