<?php

namespace ArinaSystems\TelrLaravelPayment\Listeners;

use ArinaSystems\TelrLaravelPayment\Models\Transaction;
use ArinaSystems\TelrLaravelPayment\Events\TransactionRequestCreated;

class CreateTransactionListener
{
    /**
     * Create new transaction record for create order request.
     *
     * @param  \ArinaSystems\TelrLaravelPayment\Events\TransactionRequestCreated $event
     * @return void
     */
    public function handle(TransactionRequestCreated $event)
    {
        Transaction::create([
            'ref'           => $event->request->ivp_cart,
            'payable_type'  => $event->payable->getMorphClass(),
            'payable_id'    => $event->payable->getKey(),
            'amount'        => $event->request->amount,
            'description'   => $event->request->desc,
            'trx_reference' => $event->response->order->ref,
            'request'       => $event->request->all(),
            'response'      => $event->response->all(),
        ]);
    }
}
