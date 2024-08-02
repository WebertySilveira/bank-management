<?php

namespace Tests\Unit\Repositories;

use App\Models\Account;
use App\Repositories\AccountEloquentRepository;
use Mockery;
use Tests\TestCase;

class AccountEloquentRepositoryTest extends TestCase
{
    protected $accountMock;
    protected $accountRepositoryMock;
    protected $param;

    protected function setUp(): void
    {
        $this->accountMock = Mockery::mock(Account::class);
        $this->accountRepositoryMock = new AccountEloquentRepository($this->accountMock);
        $this->param = ['account_number' => 12345, 'balance' => 222.22];
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_save_can_create_a_new_account(): void
    {
        $this->accountMock->shouldReceive('create')
            ->with($this->param)
            ->once()
            ->andReturnSelf();

        $result = $this->accountRepositoryMock->save($this->param);

        $this->assertInstanceOf(Account::class, $result);
    }

    public function test_findById_can_find_a_account()
    {
        $expectedId = '1';
        $expectedAccount = new Account($this->param);

        $this->accountMock->shouldReceive('whereId')
            ->with($expectedId)
            ->once()
            ->andReturnSelf();
        $this->accountMock->shouldReceive('first')
            ->once()
            ->andReturn($expectedAccount);

        $result = $this->accountRepositoryMock->findById($expectedId);

        $this->assertInstanceOf(Account::class, $result);
    }
}
