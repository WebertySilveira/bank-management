<?php

namespace Tests\Unit\Services;

use App\Enums\PaymentMethods;
use App\Models\Account;
use App\Models\Transaction;
use App\Repositories\TransactionEloquentRepository;
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $expectedModel;
    private $transactionRepositoryMock;
    private $transactionService;
    private $param;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedModel = \Mockery::mock(Transaction::class);
        $this->transactionRepositoryMock = \Mockery::mock(TransactionEloquentRepository::class);
        $this->transactionService = new TransactionService($this->transactionRepositoryMock);

        $account = Account::factory()->create();
        $this->param = [
            'account_id' => $account->id,
            'type' => PaymentMethods::P,
            'value' => 120.20
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }

    public function test_save_can_create_a_new_transaction()
    {
        $this->transactionRepositoryMock->shouldReceive('save')
            ->with($this->param)
            ->once()
            ->andReturn($this->expectedModel);

        $result = $this->transactionService->save($this->param);

        $this->assertInstanceOf(Transaction::class, $result);
    }
}
