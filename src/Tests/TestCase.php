<?php

namespace ArinaSystems\TelrLaravelPayment\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use ArinaSystems\TelrLaravelPayment\Providers\TelrServiceProvider;

/**
 * Class TestCase
 *
 * @package Tests
 */
abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get TelrLaravelPayment package providers.
     *
     * @return array
     */
    protected function getPackageProviders()
    {
        return [
            TelrServiceProvider::class,
        ];
    }

    /**
     * @param  $app
     * @return array
     */
    protected function getPackageAliases()
    {
        return [
            'TelrLaravelPayment' => 'ArinaSystems\TelrLaravelPayment\Facades\TelrLaravelPayment',
        ];
    }
}
