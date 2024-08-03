<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\CreateRequest;
use App\Services\AccountService;
use App\Services\PaymentService;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function store(
        CreateRequest $request,
        AccountService $accountService,
        PaymentService $paymentService,
        TransactionService $transactionService
    )
    {
        $account = $accountService->findByAccountNumber($request['numero_conta']);
        $totalValue = $request['valor'] + $paymentService->calculateFees($request);

        $newBalance = $account->balance - $totalValue;
        if ($newBalance < 0) {
            return response()->json(['mensagem' => 'saldo indisponível'], 404);
        }

        $transactionService->save([
            'account_id' => $account->id,
            'type' => $request['type'],
            'value' => $request['value']
        ]);

        $account->update(['balance' => number_format($newBalance, 2)]);

        return response()->json([
            'numero_conta' => $account['account_number'],
            'saldo' => $account['balance'],
        ], 201);
    }
}
