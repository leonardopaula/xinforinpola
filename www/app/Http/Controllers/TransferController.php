<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferPostRequest;

class TransferController extends Controller
{
    public function transfer(TransferPostRequest $request)
    {
        dd($request->input('value'));
    }
}
