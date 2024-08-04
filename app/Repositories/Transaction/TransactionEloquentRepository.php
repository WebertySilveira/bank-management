<?php

namespace App\Repositories\Transaction;

use App\Contracts\TransactionRepository;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionEloquentRepository implements TransactionRepository
{
    public function __construct(private readonly Transaction $model)
    {
    }

    public function save(array $param): Model
    {
        return $this->model->create($param);
    }
}
