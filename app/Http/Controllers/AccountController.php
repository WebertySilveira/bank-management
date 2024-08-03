<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\CreateRequest;
use App\Http\Requests\Account\ShowRequest;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function store(CreateRequest $request, AccountService $accountService)
    {
        $account = $accountService->save([
            'account_number' => $request['account_number'],
            'balance' => $request['balance']
        ]);

        return response()->json(['message' => 'Account created successfully', 'account' => $account], 201);
    }

    public function show(ShowRequest $request, AccountService $accountService)
    {
        $accountNumber = $request->query('account_number');
        $account = $accountService->findByAccountNumber($accountNumber);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        return response()->json(['account' => $account], 200);
    }
}
