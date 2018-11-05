<?php

namespace App\Test;

use App\Payment;
use PHPUnit\Framework\TestCase;

/**
 * Class PaymentTest
 */
class PaymentSetupTest extends TestCase
{
    private $transaction;
    private $response;

    public function setUp()
    {
        $this->transaction = $this->createMock(\AuthorizeNetAIM::class);
        $this->response = $this->createMock(\AuthorizeNetAIM_Response::class);
    }

    public function testProcessPaymentReturnsTrueOnSuccessfulPayment()
    {
        $paymentDetails = [
            'amount'   => 123.99,
            'card_num' => '4111-1111-1111-1111',
            'exp_date' => '03/2013',
        ];

        $this->response->approved = true;
        $this->response->transaction_id = 123;

        $this->transaction->expects($this->once())
            ->method('authorizeAndCapture')
            ->willReturn($this->response);

        $payment = new Payment();
        $result = $payment->processPayment($this->transaction, $paymentDetails);

        $this->assertTrue($result);
    }

    public function tearDown()
    {
        unset($this->transaction);
        unset($this->response);
    }
}
