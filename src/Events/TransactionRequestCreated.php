<?php

namespace ArinaSystems\TelrLaravelPayment\Events;

use Illuminate\Database\Eloquent\Model;
use ArinaSystems\TelrLaravelPayment\TelrResponse;
use ArinaSystems\TelrLaravelPayment\CreateRequest;

class TransactionRequestCreated
{
    /**
     * @var \ArinaSystems\TelrLaravelPayment\CreateRequest
     */
    public $request;

    /**
     * @var \ArinaSystems\TelrLaravelPayment\TelrResponse
     */
    public $response;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $payable;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Database\Eloquent\Model            $payable
     * @param \ArinaSystems\TelrLaravelPayment\CreateRequest $request
     * @param \ArinaSystems\TelrLaravelPayment\TelrResponse  $response
     */
    public function __construct(Model $payable, CreateRequest $request, TelrResponse $response)
    {
        $this->payable = $payable;
        $this->request = $request;
        $this->response = $response;
    }
}
