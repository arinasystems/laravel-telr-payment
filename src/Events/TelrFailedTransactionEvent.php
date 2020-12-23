<?php

namespace ArinaSystems\TelrLaravelPayment\Events;

use ArinaSystems\TelrLaravelPayment\Models\Transaction;

class TelrFailedTransactionEvent
{
    /**
     * @var \ArinaSystems\TelrLaravelPayment\Models\Transaction
     */
    public $transaction;

    /**
     * Create a new instance.
     *
     * @param  \ArinaSystems\TelrLaravelPayment\Models\Transaction $transaction
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
