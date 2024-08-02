<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryReadable
{
    public function findById(string $id): Model;
}
