<?php

namespace ArinaSystems\TelrLaravelPayment\Events;

use ArinaSystems\TelrLaravelPayment\TelrResponse;
use ArinaSystems\TelrLaravelPayment\Models\Transaction;

class TelrCallbackEvent
{
    /**
     * @var \ArinaSystems\TelrLaravelPayment\Models\Transaction
     */
    public $transaction;

    /**
     * @var \ArinaSystems\TelrLaravelPayment\TelrResponse
     */
    public $response;

    /**
     * Create a new instance.
     *
     * @param \ArinaSystems\TelrLaravelPayment\Models\Transaction $transaction
     * @param \ArinaSystems\TelrLaravelPayment\TelrResponse       $response
     */
    public function __construct(Transaction $transaction, TelrResponse $response)
    {
        $this->transaction = $transaction;
        $this->response = $response;
    }
}
