<?php

namespace App\Services;

use App\Factory\Payment;

class PaymentService
{
    public function calculateFees($paymentMethod, $value)
    {
        $paymentMethod = Payment::create($paymentMethod);
        return $paymentMethod->process($value);
    }

    public function calculateFinalAmount($paymentMethod, $value)
    {
        $fess = $this->calculateFees($paymentMethod, $value);
        return $value + $fess;
    }
}
