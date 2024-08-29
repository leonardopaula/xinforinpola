<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferPostRequest;
use App\Services\TransferService;
use Exception;

class TransferController extends Controller
{
    private $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function transfer(TransferPostRequest $request)
    {
        dd($request);
    }
}
