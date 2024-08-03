<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_account_create_route_is_working()
    {
        $response = $this->postJson('/api/conta', [
            'account_number' => '09876',
            'balance' => 150.00
        ]);

        $response->assertStatus(201)->assertJson(
            [
                'message' => 'Account created successfully'
            ]
        );
        $this->assertDatabaseHas('accounts', [
            'account_number' => '09876',
            'balance' => 150.00
        ]);
    }

    public function test_save_with_invalid_data()
    {
        $response = $this->postJson('/api/conta', [
            'account_number' => '',
            'balance' => 'a150.00'
        ]);

        $response->assertStatus(400)->assertJson(
            [
                "mensagem" => "Inconsistência nos dados",
                "data" => [
                    "account_number" => [
                        "O número da conta é obrigatório."
                    ],
                    "balance" => [
                        "O saldo deve ser um número."
                    ]
                ]
            ]
        );
    }
}
