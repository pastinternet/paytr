<?php

namespace Past\Paytr\Request;

use Past\Paytr\Enums\CardType;
use Past\Paytr\Enums\ClientLang;
use Past\Paytr\Enums\Currency;
use Past\Paytr\Enums\PaymentType;

class Config
{
    private string $apiUrl;
    private string $merchantId;
    private string $merchantSalt;
    private string $merchantKey;

    public function __construct(?array $config = [])
    {
        if ($config) {
            $this
                ->setApiUrl($config['base_uri'])
                ->setMerchantId($config['merchant_id'])
                ->setMerchantKey($config['merchant_key'])
                ->setMerchantSalt($config['merchant_salt']);
        }
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return Config
     */
    public function setApiUrl(string $apiUrl): Config
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return Config
     */
    public function setMerchantId(string $merchantId): Config
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantSalt(): string
    {
        return $this->merchantSalt;
    }

    /**
     * @param string $merchantSalt
     * @return Config
     */
    public function setMerchantSalt(string $merchantSalt): Config
    {
        $this->merchantSalt = $merchantSalt;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantKey(): string
    {
        return $this->merchantKey;
    }

    /**
     * @param string $merchantKey
     * @return Config
     */
    public function setMerchantKey(string $merchantKey): Config
    {
        $this->merchantKey = $merchantKey;
        return $this;
    }
}
