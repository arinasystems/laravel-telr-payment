<?php

namespace ArinaSystems\TelrLaravelPayment\Providers;

use Illuminate\Support\ServiceProvider;
use ArinaSystems\TelrLaravelPayment\Telr;

class TelrServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerFacade();
        $this->registerProviders();
        $this->registerMigrations();
    }

    /**
     * Register facade.
     *
     * @return void
     */
    protected function registerFacade()
    {
        $this->app->singleton('telr-payment', function ($app) {
            return new Telr();
        });
    }

    /**
     * Register providers.
     *
     * @return void
     */
    protected function registerProviders()
    {
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('telr-payment.php'),
        ], 'telr-payment-config');
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'telr-payment'
        );
    }

    /**
     * Register migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (!class_exists('CreateTelrTransactionsTable')) {
            $this->publishes([
                __DIR__ . '/../../migrations/create_transactions_table.php.stub' => base_path('database/migrations/' . date('Y_m_d_His', time()) . '_create_transactions_table.php'),
            ], 'telr-payment-migrations');
        }
    }
}
