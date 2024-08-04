<?php

namespace App\Repositories\Payments;

use App\Contracts\PaymentMethod;

class CreditPayment implements PaymentMethod
{
    public function process($amount): float
    {
        return $amount * 0.05;
    }
}
