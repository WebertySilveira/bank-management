<?php

namespace Tests\Unit\Repositories;

use App\Enums\PaymentMethods;
use App\Models\Account;
use App\Models\Transaction;
use App\Repositories\Transaction\TransactionEloquentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionEloquentRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private $transactionMock;
    private $transactionRepositoryMock;
    private $account;
    private $param;

    protected function setUp(): void
    {
        parent::setUp();

        $this->transactionMock = \Mockery::mock(Transaction::class);
        $this->transactionRepositoryMock = new TransactionEloquentRepository($this->transactionMock);

        $this->account = Account::factory()->create();
        $this->param = [
            'account_id' => $this->account->id,
            'type' => PaymentMethods::P,
            'value' => 25
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }

    public function test_save_can_create_a_new_transaction()
    {
        $this->transactionMock->shouldReceive('create')
            ->with($this->param)
            ->once()
            ->andReturnSelf();

        $result = $this->transactionRepositoryMock->save($this->param);

        $this->assertInstanceOf(Transaction::class, $result);
    }
}
