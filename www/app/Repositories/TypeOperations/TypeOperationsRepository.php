<?php

namespace App\Repositories\TypeOperations;

use App\Models\TypeOperation;
use Illuminate\Support\Facades\Cache;

class TypeOperationsRepository implements TypeOperationsRepositoryInterface
{
    private $typeOperations;

    public function __construct(TypeOperation $typeOperations)
    {
        $this->typeOperations = $typeOperations;
    }

    public function find(int $payer_type, int $payee_type)
    {
        $types = Cache::rememberForever(
            config('transfer.type_operation_cache_key'),
            function () {
                return $this->typeOperations->all();
            }
        );

        return $types
            ->where('payer_type_id', $payer_type)
            ->where('payee_type_id', $payee_type)
            ->values();
    }
}
