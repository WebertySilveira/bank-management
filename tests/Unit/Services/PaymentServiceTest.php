<?php

namespace Tests\Unit\Services;

use App\Services\PaymentService;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    private $paymentMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paymentMock = \Mockery::mock(PaymentService::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }

    public function test_P_payment_method()
    {
        $this->param = [
            'forma_pagamento' => 'P',
            'valor' => 10
        ];

        $result = (new paymentService())->calculateFees($this->param);

        $this->assertEquals(0.0, $result);
    }

    public function test_D_payment_method()
    {
        $this->param = [
            'forma_pagamento' => 'D',
            'valor' => 10
        ];

        $result = (new paymentService())->calculateFees($this->param);

        $this->assertEquals(0.3, $result);
    }

    public function test_C_payment_method()
    {
        $this->param = [
            'forma_pagamento' => 'C',
            'valor' => 10
        ];

        $result = (new paymentService())->calculateFees($this->param);

        $this->assertEquals(0.5, $result);
    }
}
