<?php

namespace App\Services;

use App\Enums\ErrorCodes;
use App\Exceptions\TransferException;
use App\Http\Requests\TransferPostRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;

class TransferService
{
    private $authService;
    private $userRepository;
    private $transactionService;


    public function __construct(
        TransferAuthService $authService,
        UserRepository $userRepository,
        TransactionService $transactionService
    ) {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
        $this->transactionService = $transactionService;
    }

    /**
     * Controls transaction flow
     *
     * @param TransferPostRequest $request
     * @return boolean
     */
    public function dispatchTransaction(TransferPostRequest $request): bool
    {
        $payer = $this->userRepository->find($request->input('payer'));
        $payee = $this->userRepository->find($request->input('payee'));

        if (empty($payer)) {
            throw new TransferException(ErrorCodes::TRANSFER_PAYER_NOT_FOUND);
        }

        if (empty($payee)) {
            throw new TransferException(ErrorCodes::TRANSFER_PAYEE_NOT_FOUND);
        }

        $this->authService->canExecuteAction($payer, $payee);
        $this->authorizeTransaction($payer, $payee, $request->input('value'));

        $this->transactionService->executeTransaction($payer, $payee, $request->input('value'));

        return false;
    }

    /**
     * Check authorization with remote service
     *
     * @param User $payer
     * @param User $payee
     * @param float $value
     * @return boolean
     */
    private function authorizeTransaction(User $payer, User $payee, float $value): bool
    {
        return $this->authService->hasAuthorization();
    }
}
