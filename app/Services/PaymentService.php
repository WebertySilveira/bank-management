<?php

namespace App\Services;

class PaymentService
{
    const D = 'D';
    const C = 'C';
    const P = 'P';

    public function calculateFees($transaction)
    {
        $paymentMethod = $transaction['forma_pagamento'];
        $value = $transaction['valor'];

        $totalFee = $this->getFeeForPaymentMethod($paymentMethod, $value);
        return number_format($totalFee, 2);
    }

    private function getFeeForPaymentMethod(string $paymentMethod, $value): float
    {
        return match ($paymentMethod) {
            self::P => $value * 0.00,
            self::D => $value * 0.03,
            self::C => $value * 0.05,
        };
    }
}
