<?php

namespace App\Services;

use App\Contracts\TransactionRepository;
use App\Repositories\TransactionEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class TransactionService implements TransactionRepository
{
    public function __construct(private readonly TransactionEloquentRepository $repository)
    {
    }

    public function save(array $param): Model
    {
        return $this->repository->save($param);
    }
}
