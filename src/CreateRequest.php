<?php

namespace ArinaSystems\TelrLaravelPayment;

use Illuminate\Support\Str;

class CreateRequest extends TelrRequest
{
    /**
     * Create a new instance.
     *
     * @param  float|array $amount
     * @param  string      $description
     * @param  array       $billing_info
     * @return void
     */
    public function __construct($amount, $description = null, array $billing_info = [])
    {
        $config = is_array($amount) ? $amount : $billing_info + [
            'method' => 'create',
            'cart'   => (string) Str::orderedUuid() . '-' . time(),
            'amount' => $amount,
            'desc'   => $description,
        ];

        parent::__construct($config);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->all();
    }
}
