<?php

namespace App\Repositories;

use App\Contracts\AccountRepository;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

class AccountEloquentRepository implements AccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly Account $model)
    {
    }

    public function save(array $param): Model
    {
        return $this->model::create($param);
    }

    public function findById(string $id): Model
    {
        return $this->model::whereId($id)->first();
    }
}
