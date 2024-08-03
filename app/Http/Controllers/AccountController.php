<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\CreateRequest;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function store(CreateRequest $request, AccountService $accountService)
    {
        $validatedData = $request->validated();

        $account = $accountService->save([
            'account_number' => $validatedData['account_number'],
            'balance' => $validatedData['balance']
        ]);

        return response()->json(['message' => 'Account created successfully', 'account' => $account], 201);
    }
}
