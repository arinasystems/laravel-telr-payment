<?php

namespace ArinaSystems\TelrLaravelPayment\Traits;

use ArinaSystems\TelrLaravelPayment\Facades\Telr;

trait Payable
{
    /**
     * Get all of the model's transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions()
    {
        return $this->morphMany(config('telr-payment.model'), 'payable');
    }

    /**
     * Get create order request for this model.
     *
     * @param  float                                            $amount
     * @param  nullstring                                       $description
     * @param  array                                            $billing_info
     * @throws \Exception
     * @return \ArinaSystems\TelrLaravelPayment\CreateRequest
     */
    public function requestTelr(float $amount = null, string $description = null, array $billing_info = [])
    {
        (float) $amount = !is_null($amount) ? $amount : $this->getAmountToPay();
        (string) $description = !is_null($description) ? $description : $this->getDescriptionToPay();

        return Telr::pay($this, $amount, $description, $billing_info);
    }

    /**
     * Redircet to Telr pay page.
     *
     * @param  float                               $amount
     * @param  nullstring                          $description
     * @param  array                               $billing_info
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectTelr(float $amount = null, string $description = null, array $billing_info = [])
    {
        return $this->requestTelr($amount, $description, $billing_info)->redirect();
    }

    /**
     * Retrieve model' amount value.
     *
     * @return float
     */
    public function getAmountToPay()
    {
        return $this->amount;
    }

    /**
     * Retrieve model' payment description.
     *
     * @return string
     */
    public function getDescriptionToPay()
    {
        return 'Subscription for ' . config('app.name');
    }
}
