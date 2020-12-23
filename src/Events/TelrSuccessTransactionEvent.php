<?php

namespace ArinaSystems\TelrLaravelPayment\Events;

use ArinaSystems\TelrLaravelPayment\Models\Transaction;

class TelrSuccessTransactionEvent
{
    /**
     * @var \ArinaSystems\TelrLaravelPayment\Models\Transaction
     */
    public $transaction;

    /**
     * Create a new instance.
     *
     * @param \ArinaSystems\TelrLaravelPayment\Models\Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
