<?php

namespace ArinaSystems\TelrLaravelPayment\Listeners;

use ArinaSystems\TelrLaravelPayment\Events\TelrCallbackEvent;
use ArinaSystems\TelrLaravelPayment\Events\TelrFailedTransactionEvent;
use ArinaSystems\TelrLaravelPayment\Events\TelrSuccessTransactionEvent;

class TelrCallbackListener
{
    /**
     * Update transaction with callback response data.
     *
     * @param  TelrCallbackEvent $event
     * @return void
     */
    public function handle(TelrCallbackEvent $event)
    {
        $event->transaction->update([
            'response' => $event->response->all(),
            'status'   => $status = $event->response->order->status->text,
        ]);

        if ($status === 'Paid') {
            event(new TelrSuccessTransactionEvent($event->transaction));
        }

        event(new TelrFailedTransactionEvent($event->transaction));
    }
}
