<?php

namespace Tests\Unit\Services;

use App\Models\Account;
use App\Repositories\AccountEloquentRepository;
use App\Services\AccountService;
use Mockery;
use Tests\TestCase;

class AccountServiceTest extends TestCase
{
    private $expectedModel;
    private $repositoryMock;
    private $accountService;
    private $param;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedModel = Mockery::mock(Account::class);
        $this->repositoryMock = Mockery::mock(AccountEloquentRepository::class);
        $this->accountService = new AccountService($this->repositoryMock);
        $this->param = [
            'account_number' => '12345',
            'balance' => 222.22
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function test_findById_find_and_return_account()
    {
        $this->repositoryMock->shouldReceive('findById')
            ->with(1)
            ->once()

            ->andReturn($this->expectedModel);

        $result = $this->accountService->findById(1);

        $this->assertInstanceOf(Account::class, $result);
    }

    public function test_save_can_create_a_new_account()
    {
        $this->repositoryMock->shouldReceive('save')
            ->with($this->param)
            ->once()
            ->andReturn($this->expectedModel);

        $result = $this->accountService->save($this->param);

        $this->assertInstanceOf(Account::class, $result);
    }

    public function test_findByAccountNumber_find_and_return_account()
    {
        $this->repositoryMock->shouldReceive('findByAccountNumber')
            ->with($this->param['account_number'])
            ->once()
            ->andReturn($this->expectedModel);

        $result = $this->accountService->findByAccountNumber($this->param['account_number']);

        $this->assertInstanceOf(Account::class, $result);
    }
}
