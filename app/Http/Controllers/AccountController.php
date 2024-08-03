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

        return response()->json([
            'numero_conta' => $account['account_number'],
            'saldo' => $account['balance'],
        ], 201);
    }

    public function show(ShowRequest $request, AccountService $accountService)
    {
        $accountNumber = $request->query('numero_conta');
        $account = $accountService->findByAccountNumber($accountNumber);
        if (!$account) {
            return response()->json(['message' => 'Conta não encontrada'], 404);
        }

        return response()->json([
            'numero_conta' => $account['account_number'],
            'saldo' => $account['balance'],
        ], 200);
    }
}
