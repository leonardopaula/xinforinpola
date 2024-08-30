<?php

namespace App\Repositories\TypeOperations;

use App\Models\TypeOperation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Cache;

class TypeOperationsRepository implements TypeOperationsRepositoryInterface
{
    private $typeOperations;

    public function __construct(TypeOperation $typeOperations)
    {
        $this->typeOperations = $typeOperations;
    }

    /**
     * Find configuration of transaction using cache
     *
     * @param integer $payer_type
     * @param integer $payee_type
     * @return SupportCollection
     */
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
