<?php

namespace App\Services;

class TransferService
{
    private $authService;

    public function __construct(TransferAuthService $authService)
    {
        $this->authService = $authService;
        $this->authService->hasAuthorization();
    }
}
