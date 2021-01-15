<?php

namespace ArinaSystems\TelrLaravelPayment;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use ArinaSystems\TelrLaravelPayment\Models\Transaction;
use ArinaSystems\TelrLaravelPayment\Events\TelrCallbackEvent;
use ArinaSystems\TelrLaravelPayment\Events\TransactionRequestCreated;

class Telr
{
    /**
     * Initiate create order request on telr.
     *
     * @param  \Illuminate\Database\Eloquent\Model              $payable
     * @param  float                                            $amount
     * @param  string                                           $description
     * @param  array                                            $billing_info
     * @throws \Exception
     * @return \ArinaSystems\TelrLaravelPayment\CreateRequest
     */
    public function pay(Model $payable, float $amount, string $description, array $billing_info = [])
    {
        $request = new CreateRequest($amount, $description, $billing_info);

        $response = $request->send();

        $request->set('redirect_url', $response->order->url);

        event(new TransactionRequestCreated($payable, $request, $response));

        return $request;
    }

    /**
     * Handle callback request and retrieve payment transaction object.
     *
     * @param  \Illuminate\Http\Request                                          $request
     * @throws \Exception|\Illuminate\Database\Eloquent\ModelNotFoundException
     * @return \ArinaSystems\TelrLaravelPayment\Models\Transaction
     */
    public function callback(Request $request)
    {
        $transaction = Transaction::where('order_id', $request->ref)->firstOrFail();

        $request = new CheckRequest($transaction);

        $response = $request->send();

        event(new TelrCallbackEvent($transaction, $response));

        return $transaction;
    }
}
