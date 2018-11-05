<?php

namespace App\Test;

use App\Payment;
use PHPUnit\Framework\TestCase;

/**
 * Class PaymentTest
 */
class PaymentTest extends TestCase
{
    public function testProcessPaymentReturnsTrueOnSuccessfulPayment()
    {
        $paymentDetails = array(
            'amount'   => 1234.99,
            'card_num' => '4111-1111-1111-1111',
            'exp_date' => '11/2018',
        );

        $transaction = $this->createMock(\AuthorizeNetAIM::class);

        $response = $this->createMock(\AuthorizeNetAIM_Response::class);
        $response->approved = true;
        $response->transaction_id = 123;

        $transaction->expects($this->once())
            ->method('authorizeAndCapture')
            ->willReturn($response);

        $payment = new Payment();
        $result = $payment->processPayment($transaction, $paymentDetails);

        $this->assertTrue($result);
    }
}
