<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferPostRequest;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class TransferController extends Controller
{
    private $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function transfer(TransferPostRequest $request)
    {
        $this->transferService->dispatchTransaction($request);
    }

    public function clearCache()
    {
        Cache::forget(config('transfer.type_operation_cache_key'));

        return response()->json([
            'success' => true,
        ], Response::HTTP_NO_CONTENT);
    }
}
