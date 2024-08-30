<?php

namespace App\Exceptions;

use App\Enums\ErrorCodes;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TransferException extends Exception
{
    protected $code;
    protected $message;
    protected $httpCode;

    /**
     * Breaks errors info into variables
     *
     * @param ErrorCodes $errorCode
     */
    public function __construct(ErrorCodes $errorCode)
    {
        $errorInfo = $errorCode->info();
        $this->message = $errorInfo['message'];
        $this->code = $errorCode->value;
        $this->httpCode = $errorInfo['httpCode'];
    }

    /**
     * Report exception
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->message);
    }

    /**
     * Report error
     */
    public function render()
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'code' => $this->code,
        ], $this->httpCode);
    }
}
