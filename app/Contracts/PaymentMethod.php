<?php

namespace App\Contracts;

interface PaymentMethod
{
    public function process($amount): float;
}
