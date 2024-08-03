<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\CreateRequest;
use App\Services\AccountService;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function store(CreateRequest $request, AccountService $accountService, TransactionService $transactionService)
    {
        $account = $accountService->findByAccountNumber($request['numero_conta']);

        $newBalance = $account->balance - $request['valor'];
        if ($newBalance < 0){
            return response()->json(['mensagem' => 'saldo indisponível'], 404);
        }

        $transactionService->save([
            'account_id' => $account->id,
            'type' => $request['type'],
            'value' => $request['value']
        ]);

        $account->update(['balance' => $newBalance]);

        return response()->json([
            'numero_conta' => $account['account_number'],
            'saldo' => $account['balance'],
        ], 201);
    }
}
