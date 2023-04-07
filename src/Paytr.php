<?php

namespace Past\Paytr;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Past\Paytr\Request\Basket;
use Past\Paytr\Request\Payment;
use Past\Paytr\Request\PaymentVerification;
use Past\Paytr\Response\PaytrResponse;

class Paytr
{
    private Client $client;
    private array $credentials;
    private array $options;

    public function __construct(Client $client, array $credentials = [], array $options = [])
    {
        $this->client = $client;
        $this->credentials = $credentials;
        $this->options = $options;
    }

    /**
     * @param Payment $payment
     * @return PaytrResponse
     */
    public function create(Payment $payment): PaytrResponse
    {
        return $payment->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options)
            ->create();
    }

    /**
     * @return Payment
     */
    public function payment(): Payment
    {
        return new Payment();
    }

    /**
     * @return Basket
     */
    public function basket(): Basket
    {
        return new Basket();
    }

    /**
     * @param Request $request
     * @return PaymentVerification
     */
    public function verify(Request $request): PaymentVerification
    {
        $verification = new PaymentVerification($request);
        $verification->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
        return $verification;
    }
}