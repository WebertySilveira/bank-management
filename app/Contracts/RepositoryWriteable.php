<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryWriteable
{
    public function save(array $param): Model;
}
