<?php

namespace ArinaSystems\TelrLaravelPayment;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Config\Repository;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\Support\Arrayable;

abstract class TelrRequest extends Repository implements Arrayable
{
    const IVP_INFO     = ['method', 'store', 'authkey', 'cart', 'test', 'amount', 'currency', 'desc', 'lang'];
    const BILLING_INFO = ['email', 'title', 'fname', 'sname', 'addr1', 'addr2', 'addr3', 'city', 'region', 'country', 'zip', 'custref', 'phone'];

    /**
     * Create a new instance.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->set($config + config('telr-payment', []));
    }

    /**
     * Send HTTP request to Telr server.
     *
     * @throws \Exception
     * @return TelrResponse
     */
    public function send()
    {
        try {
            $response = (new Client())->post($this->endpoint, ['form_params' => $this->toArray()]);
            $response = (array) \GuzzleHttp\json_decode($response->getBody()->getContents());
            $response = (new TelrResponse($response));
        } catch (TransferException $th) {
            throw new \Exception($th->getMessage(), $th->getCode());
        }

        if ($response->has('error')) {
            throw new \Exception($response->error->message . '. ' . ($response->error->note ?? $response->error->field) . '. ' . $response->error->details);
        }

        return $response;
    }

    /**
     * Redirect to pay order page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        if ($this->has('redirect_url')) {
            $response = $this->send();
            $this->set('redirect_url', $response->order->url);
        }

        return redirect()->to($this->redirect_url);
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
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            $key = $this->handleKey($key);
            $value = Str::startsWith($key, 'return_') ? $this->appendCartToUrl($value) : $value;
            Arr::set($this->items, $key, $value);
        };

        return $this;
    }

    /**
     * Get the specified configuration value.
     *
     * @param  array|string $key
     * @param  mixed        $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return parent::get($this->handleKey($key), $default);
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
     * Get a valid key name,
     *
     * @param  string   $name
     * @return string
     */
    protected function handleKey(string $name)
    {
        if (Str::contains($name, static::IVP_INFO) && !Str::contains($name, 'ivp_')) {
            return "ivp_{$name}";
        }

        if (Str::contains($name, static::BILLING_INFO) && !Str::contains($name, 'bill_')) {
            return "bill_{$name}";
        }

        return $name;
    }

    /**
     * Append order id to URL
     *
     * @param  string   $url
     * @return string
     */
    protected function appendCartToUrl($url)
    {
        $url = url($url);

        $query = parse_url($url, PHP_URL_QUERY);

        return $url .= ($query ? '&' : '?') . 'ref=' . $this->cart;
    }
}
