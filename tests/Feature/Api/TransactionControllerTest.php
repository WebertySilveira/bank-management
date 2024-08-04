<?php

namespace Tests\Feature\Api;

use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $account;

    protected function setUp(): void
    {
        parent::setUp();

        $this->account = Account::create([
            'account_number' => '12345',
            'balance' => 222.22,
        ]);
    }


    public function test_if_store_transaction_route_is_working()
    {
        $response = $this->postJson(
            '/api/transacao',
            [
                'forma_pagamento' => "D",
                'numero_conta' => $this->account->account_number,
                'valor' => 10.10
            ]
        );

        $response->assertStatus(201);
    }

    public function test_validation_of_transaction_low_than_zero()
    {
        $response = $this->postJson(
            '/api/transacao',
            [
                'forma_pagamento' => "D",
                'numero_conta' => $this->account->account_number,
                'valor' => $this->account->balance + 10
            ]
        );

        $response->assertStatus(404)->assertJson([
            'mensagem' => 'saldo indisponível'
        ]);

        $this->account->refresh();
        $this->assertEquals(222.22, $this->account->balance);
    }
}
