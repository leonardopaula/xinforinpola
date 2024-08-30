<?php

namespace App\Enums;

use Illuminate\Http\Response;

enum ErrorCodes: int
{
    case TRANSFER_AUTH_ERROR = 10001;
    case TRANSFER_UNAUTHORIZED_TRANSFER = 10002;
    case TRANSFER_PAYER_NOT_FOUND = 10003;
    case TRANSFER_PAYEE_NOT_FOUND = 10004;
    case TRANSFER_TYPE_CONFIGURATION_NOT_FOUND = 10005;
    case TRANSFER_INVALID_USER_TYPE_TRANSACTION = 10006;
    case TRANSACTION_PAYER_WALLET_NOT_FOUND = 10007;
    case TRANSACTION_PAYEE_WALLET_NOT_FOUND = 10008;
    case TRANSACTION_INSUFFICIENT_BALANCE = 10009;

    public function info(): array
    {
        return static::getInfo($this);
    }

    public static function getInfo(self $value): array
    {
        return match ($value) {
            ErrorCodes::TRANSFER_AUTH_ERROR => [
                'message' => 'Authorization service failure',
                'httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR
            ],
            ErrorCodes::TRANSFER_UNAUTHORIZED_TRANSFER => [
                'message' => 'Authorization service returns unauthorized transfer',
                'httpCode' => Response::HTTP_BAD_REQUEST
            ],
            ErrorCodes::TRANSFER_PAYER_NOT_FOUND => [
                'message' => 'Payer not found',
                'httpCode' => Response::HTTP_BAD_REQUEST
            ],
            ErrorCodes::TRANSFER_PAYEE_NOT_FOUND => [
                'message' => 'Payee not found',
                'httpCode' => Response::HTTP_BAD_REQUEST
            ],
            ErrorCodes::TRANSFER_TYPE_CONFIGURATION_NOT_FOUND => [
                'message' => 'Configuration payee type x payer type not found',
                'httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR
            ],
            ErrorCodes::TRANSFER_INVALID_USER_TYPE_TRANSACTION => [
                'message' => 'Payer incompatible with payee',
                'httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR
            ],
            ErrorCodes::TRANSACTION_PAYER_WALLET_NOT_FOUND => [
                'message' => 'Payer wallet not found',
                'httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR
            ],
            ErrorCodes::TRANSACTION_PAYEE_WALLET_NOT_FOUND => [
                'message' => 'Payee wallet not found',
                'httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR
            ],
            ErrorCodes::TRANSACTION_INSUFFICIENT_BALANCE => [
                'message' => 'Insufficient balance',
                'httpCode' => Response::HTTP_BAD_REQUEST
            ],
        };
    }
}
