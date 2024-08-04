<?php

namespace App\Repositories\Payments;

use App\Contracts\PaymentMethod;

class DebitPayment implements PaymentMethod
{
    public function process($amount): float
    {
        return $amount * 0.03;
    }
}
