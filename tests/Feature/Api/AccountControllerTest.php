<?php

namespace Tests\Feature\Api;

use App\Models\Account;
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

    public function test_account_show_route_is_working()
    {
        Account::create([
            'account_number' => '12345',
            'balance' => '222.22',
        ]);

        $response = $this->get('/api/conta?account_number=12345');

        $response->assertStatus(200)->assertJson(
            [
                'account' =>
                    [
                        'account_number' => '12345',
                        'balance' => '222.22',
                    ]
            ]
        );
    }

    public function test_account_show_route_with_invalid_account()
    {
        Account::create([
            'account_number' => '12345',
            'balance' => '222.22',
        ]);

        $response = $this->get('/api/conta?account_number=1234');

        $response->assertStatus(404)->assertJson(
            [
                'message' => 'Account not found'
            ]
        );
    }

    public function test_show_with_invalid_data()
    {
        $response = $this->get('/api/conta');

        $response->assertStatus(400)->assertJson(
            [
                'mensagem' => 'Inconsistência nos dados',
                'data' => [
                    "account_number" => ["O número da conta é obrigatório."]
                ]
            ]
        );
    }
}
