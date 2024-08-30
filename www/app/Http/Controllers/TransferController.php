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

    /**
     * Start the transaction
     *
     * @param TransferPostRequest $request
     * @return void
     */
    public function transfer(TransferPostRequest $request)
    {
        try {
            $this->transferService->dispatchTransaction($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'code' => 0,
                'message' => 'An error occurred'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction successfully executed'
        ], Response::HTTP_OK);
    }

    /**
     * Utility to clear cache
     *
     * @return void
     */
    public function clearCache()
    {
        Cache::forget(config('transfer.type_operation_cache_key'));

        return response()->json([
            'success' => true,
        ], Response::HTTP_NO_CONTENT);
    }
}
