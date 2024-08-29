<?php

namespace App\Services;

use App\Enums\ErrorCodes;
use App\Exceptions\TransferException;
use Illuminate\Support\Facades\Http;

class TransferAuthService
{
    public function hasAuthorization()
    {
        $request = Http::acceptJson()
            ->retry(config('transfer.auth_retry'), config('transfer.auth_retry_wait'))
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

        throw new TransferException(ErrorCodes::TRANSFER_AUTH_ERROR);
    }
}
