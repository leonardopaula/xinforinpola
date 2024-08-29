<?php

namespace App\Exceptions;

use App\Enums\ErrorCodes;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class TransferException extends Exception
{
    protected $code;
    protected $message;
    protected $httpCode;

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
        // TODO: report error
    }

    /**
     * Report error
     */
    public function render()
    {
        return new HttpResponseException(response()->json([
            'success' => false,
            'message' => $this->message,
            'code' => $this->code,
        ], $this->httpCode));
    }
}
