<?php

namespace ArinaSystems\TelrLaravelPayment;

use ArinaSystems\TelrLaravelPayment\Models\Transaction;

class CheckRequest extends TelrRequest
{
    /**
     * @var \ArinaSystems\TelrLaravelPayment\Models\Transaction
     */
    protected $transaction;

    /**
     * Create a new instance.
     *
     * @param \ArinaSystems\TelrLaravelPayment\Models\Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;

        parent::__construct((array) $transaction->request);

        $this->method = 'check';
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return ['order_ref' => $this->transaction->trx_reference] + $this->all();
    }
}
