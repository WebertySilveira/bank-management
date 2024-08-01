<?php

namespace Tests\Feature\Model;

use App\Models\Account;
use Tests\TestCase;

class AccountTest extends TestCase
{
    public function test_the_application_can_create_a_account(): void
    {
        $account = Account::factory()->create([
            'account_number' => '12345',
            'balance' => 222.22
        ]);

        $this->assertInstanceOf(Account::class, $account);
        $this->assertEquals($account->account_number, '12345');
        $this->assertEquals($account->balance, 222.22);
    }
}
