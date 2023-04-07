<?php

namespace Past\Paytr;

use GuzzleHttp\Client;

class PaytrClient
{
    private Client $client;
    private array $credentials = [];
    private array $options = [];

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return $this
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array $credentials
     * @return $this
     */
    public function setCredentials(array $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function call(string $method, string $url, array $params = [], array $headers = [])
    {
        $options = ['timeout' => $this->options['timeout']];

        if ($headers) {
            $options['headers'] = $headers;
        }

        if ($method === 'GET') {
            $options['query'] = $params;
        }

        if ($method === 'POST') {
            $options['json'] = $params;
        }

        if ($method === 'PUT') {
            $options['json'] = $params;
        }

        return $this->client->request($method, sprintf('%s/%s', $this->getCredentials()['base_uri'], $url), $options);
    }

}