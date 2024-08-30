<?php

namespace App\Services;

use App\Enums\ErrorCodes;
use App\Exceptions\TransferException;
use App\Models\User;
use App\Repositories\TypeOperations\TypeOperationsRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class TransferAuthService
{

    private $typeOperations;

    public function __construct(TypeOperationsRepository $typeOperations)
    {
        $this->typeOperations = $typeOperations;
    }

    public function canExecuteAction(User $payer, User $payee): bool
    {
        $operations = $this->typeOperations->find($payer->type_id, $payee->type_id);

        if (empty($operations) || count($operations) !== 1) {
            throw new TransferException(ErrorCodes::TRANSFER_TYPE_CONFIGURATION_NOT_FOUND);
        }

        if ($operations[0]['enabled'] === false) {
            throw new TransferException(ErrorCodes::TRANSFER_INVALID_USER_TYPE_TRANSACTION);
        }

        return true;
    }

    public function hasAuthorization(): bool
    {
        try {
            $request = Http::acceptJson()
                ->retry(config('transfer.auth_retry'), config('transfer.auth_retry_wait'), throw: false)
                ->get(config('transfer.auth_endpoint'));

            if ($request->successful()) {
                $response = $request->json();

                if ($response['status'] === 'success') {
                    if ($response['data']['authorization'] === true) {
                        return true;
                    }
                    throw new TransferException(ErrorCodes::TRANSFER_UNAUTHORIZED_TRANSFER);
                }
            }
        } catch (Exception $e) {
            throw new TransferException(ErrorCodes::TRANSFER_AUTH_ERROR);
        }

        throw new TransferException(ErrorCodes::TRANSFER_AUTH_ERROR);
    }
}
