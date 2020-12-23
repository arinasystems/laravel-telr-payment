<?php

return [
    /**
     * The sale endpoint that receive the params
     *
     * @see https://telr.com/support/knowledge-base/hosted-payment-page-integration-guide
     */
    'endpoint'    => 'https://secure.telr.com/gateway/order.json',

    /**
     * Test mode indicator.
     */
    'test'        => env('TELR_TEST_MODE', true),

    /**
     * Set a one of supported currencies code.
     *
     * @see https://telr.com/support/knowledge-base/hosted-payment-page-integration-guide/#supported-currency-codes
     */
    'currency'    => env('TELR_CURRENCY', 'AED'),

    /**
     * The hosted payment page use the following params as it explained in the integration guide
     *
     * @see https://telr.com/support/knowledge-base/hosted-payment-page-integration-guide/#request-method-and-format
     */
    'store'       => env('TELR_STORE_ID', null),
    'authkey'     => env('TELR_STORE_AUTH_KEY', null),

    /**
     * Payment Page interface language
     * This should be a value of "en" or "ar" which are the currently supported languages.
     */
    'lang'        => env('APP_LOCALE', 'en'),

    /**
     * URL for authorised transactions
     */
    'return_auth' => '/payment/callback',

    /**
     * URL for cancelled transactions
     */
    'return_can'  => '/payment/callback',

    /**
     * URL for declined transactions
     */
    'return_decl' => '/payment/callback',
];
