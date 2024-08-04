<?php

namespace App\Repositories\Payments;

use App\Contracts\PaymentMethod;

class PixPayment implements PaymentMethod
{
    public function process($amount): float
    {
        return 0;
    }
}
