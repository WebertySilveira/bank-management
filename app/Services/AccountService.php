<?php

namespace App\Services;

use App\Contracts\AccountRepository;
use App\Repositories\Account\AccountEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class AccountService implements AccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly AccountEloquentRepository $repository)
    {
    }

    public function findById(string $id): Model
    {
        return $this->repository->findById($id);
    }

    public function findByAccountNumber(string $accountNumber): ?Model
    {
        return $this->repository->findByAccountNumber($accountNumber);
    }

    public function save(array $param): Model
    {
        return $this->repository->save($param);
    }
}
