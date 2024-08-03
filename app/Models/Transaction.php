<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
    ];

    protected $casts = [
        'type' => PaymentMethods::class,
    ];
}
