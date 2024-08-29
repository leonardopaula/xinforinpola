<?php

namespace App\Enums;

use Illuminate\Http\Response;

enum ErrorCodes: int
{
    case TRANSFER_AUTH_ERROR = 10001;
    case TRANSFER_UNAUTHORIZED_TRANSFER = 10002;

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
            ]
        };
    }
}
