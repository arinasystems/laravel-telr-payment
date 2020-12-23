<?php

namespace ArinaSystems\TelrLaravelPayment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Telr Payment Gateway
 *
 * @method static \Illuminate\Http\TelrLaravelPayment pay(\Illuminate\Database\Eloquent\Model $payable, float $amount, string $description, array $billing_info = []) Initiate create order request on telr.
 * @method static \ArinaSystems\TelrLaravelPayment\Models\Transaction callback(\Illuminate\Http\Request $request) Handle callback request and retrieve payment transaction object.
 */
class Telr extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'telr-payment';
    }
}
