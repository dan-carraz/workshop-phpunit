<?php

namespace App;

/**
 * Class Payment
 */
class Payment
{
    const API_ID = 123456;
    const TRANS_KEY = 'TRANSACTION KEY';

    /**
     * @param array $paymentDetails
     *
     * @return bool
     *
     * @throws \Exception
     */
    /*
    public function processPayment(array $paymentDetails): bool
    {
        $transaction = new \AuthorizeNetAIM(self::API_ID, self::TRANS_KEY);
        $transaction->amount = $paymentDetails['amount'];
        $transaction->card_num = $paymentDetails['card_num'];
        $transaction->exp_date = $paymentDetails['exp_date'];

        $response = $transaction->authorizeAndCapture();

        if ($response->approved) {
            return $this->savePayment($response->transaction_id);
        } else {
            throw new \Exception($response->error_message);
        }
    }
    */

    public function processPayment(\AuthorizeNetAIM $transaction, array $paymentDetails)
    {
        $transaction->amount = $paymentDetails['amount'];
        $transaction->card_num = $paymentDetails['card_num'];
        $transaction->exp_date = $paymentDetails['exp_date'];

        $response = $transaction->authorizeAndCapture();

        if ($response->approved) {
            return $this->savePayment($response->transaction_id);
        }

        throw new \Exception($response->error_message);
    }


    /**
     * @param int $transactionId
     * @return bool
     */
    public function savePayment(int $transactionId): bool
    {
        // Logic for saving transaction ID to database or anywhere else would go in here
        return true;
    }
}
