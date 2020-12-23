<?php

namespace ArinaSystems\TelrLaravelPayment\Providers;

use ArinaSystems\TelrLaravelPayment\Events\TelrCallbackEvent;
use ArinaSystems\TelrLaravelPayment\Listeners\TelrCallbackListener;
use ArinaSystems\TelrLaravelPayment\Events\TransactionRequestCreated;
use ArinaSystems\TelrLaravelPayment\Listeners\CreateTransactionListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the package.
     *
     * @var array
     */
    protected $listen = [
        TransactionRequestCreated::class => [
            CreateTransactionListener::class,
        ],

        TelrCallbackEvent::class         => [
            TelrCallbackListener::class,
        ],
    ];
}
