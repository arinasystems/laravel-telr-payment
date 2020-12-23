<?php

namespace ArinaSystems\TelrLaravelPayment;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Support\Arrayable;

class TelrResponse extends Repository implements Arrayable
{
    /**
     * Create a new instance.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->set($response);
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string $key
     * @param  mixed        $value
     * @return self
     */
    public function set($key, $value = null)
    {
        parent::set($key, $value);
        return $this;
    }

    /**
     * Set a given configuration value.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function __set(string $key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Get the specified configuration value.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->get($key);
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
