<?php

namespace App\Repositories\TypeOperations;

interface TypeOperationsRepositoryInterface
{
    public function find(int $payer_type, int $payee_type);
}
