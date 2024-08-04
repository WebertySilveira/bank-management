<?php

namespace App\Factory;

use App\Contracts\PaymentMethod;
use App\Repositories\Payments\CreditPayment;
use App\Repositories\Payments\DebitPayment;
use App\Repositories\Payments\PixPayment;

class Payment
{
    public static function create($type): PaymentMethod
    {
        return match ($type) {
            'P' => new PixPayment(),
            'C' => new CreditPayment(),
            'D' => new DebitPayment(),
        };
    }
}
