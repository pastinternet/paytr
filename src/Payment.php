<?php

namespace Past\Paytr;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Past\Paytr\Enums\PaymentType;
use Past\Paytr\Enums\TransactionType;
use Past\Paytr\Request\Config;
use Past\Paytr\Request\Option;
use Past\Paytr\Request\Order;

class Payment
{
    private Client $client;
    private Config $config;
    private Option $option;

    public function __construct(?array $config = [], ?array $options = [])
    {
        if ($config) {
            $this->setConfig(new Config($config));
        }

        if ($options) {
            $this->setOption(new Option($options));
        }

        $this->client = new Client();
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return Payment
     */
    public function setConfig(Config $config): Payment
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return Option
     */
    public function getOption(): Option
    {
        return $this->option;
    }

    /**
     * @param Option $option
     * @return Payment
     */
    public function setOption(Option $option): Payment
    {
        $this->option = $option;
        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return Payment
     */
    public function setOrder(Order $order): Payment
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    protected function generateHash(): string
    {
        if ($this->getOption()->getTransactionType() == TransactionType::DIRECT) {
            return (string)$this->getConfig()->getMerchantId() .
                (string)$this->getOrder()->getUserIp() .
                (string)$this->getOrder()->getMerchantOrderId() .
                (string)$this->getOrder()->getEmail() .
                (string)$this->getOrder()->getPaymentAmount() .
                (string)PaymentType::CARD->value .
                (int)$this->getOption()->getInstallmentCount() .
                (string)$this->getOption()->getCurrency()->value .
                (int)$this->getOption()->isTestMode() .
                (int)$this->getOption()->isNon3d();
        }

        if ($this->getOption()->getTransactionType() == TransactionType::IFRAME) {
            return (string)$this->getConfig()->getMerchantId() .
                (string)$this->getOrder()->getUserIp() .
                (string)$this->getOrder()->getMerchantOrderId() .
                (string)$this->getOrder()->getEmail() .
                (string)$this->getOrder()->getPaymentAmountFormatted() .
                (string)$this->getOrder()->getBasket()->getFormattedBase64() .
                (int)$this->getOption()->isNoInstallment() .
                (int)$this->getOption()->getMaxInstallment() .
                (string)$this->getOption()->getCurrency()->value .
                (int)$this->getOption()->isTestMode();
        }

        if ($this->getOption()->getTransactionType() == TransactionType::IFRAME_TRANSFER) {
            return (string)$this->getConfig()->getMerchantId() .
                (string)$this->getOrder()->getUserIp() .
                (string)$this->getOrder()->getMerchantOrderId() .
                (string)$this->getOrder()->getEmail() .
                (string)$this->getOrder()->getPaymentAmountFormatted() .
                (string)PaymentType::EFT->value .
                (int)$this->getOption()->isTestMode();
        }
    }

    /**
     * @return string
     */
    public function generateHashToken(): string
    {
        return base64_encode(hash_hmac('sha256', sprintf('%s%s', $this->getOrder()->getHash(), $this->getConfig()->getMerchantSalt()), $this->getConfig()->getMerchantKey(), true));
    }

    public function checkHash(): bool
    {
        $request = Request::createFromGlobals();

        $hash = $request->input('merchant_oid') .
            $this->getConfig()->getMerchantSalt() .
            $request->input('status') .
            $request->input('total_amount');

        $hashToken = base64_encode(hash_hmac('sha256', $hash, $this->getConfig()->getMerchantKey(), true));

        return $hashToken == $request->input('hash');
    }

    /**
     * @return array
     */
    public function generateData(): array
    {
        $this->getOrder()->setHash($this->generateHash());

        $data = [
            'merchant_id' => (string)$this->getConfig()->getMerchantId(),
            'merchant_oid' => (string)$this->getOrder()->getMerchantOrderId(),
            'paytr_token' => (string)$this->generateHashToken(),
            'user_name' => (string)$this->getOrder()->getUserName(),
            'user_address' => (string)$this->getOrder()->getUserAddress(),
            'email' => (string)$this->getOrder()->getEmail(),
            'user_phone' => (string)$this->getOrder()->getUserPhone(),
            'user_basket' => (string)$this->getOrder()->getBasket()->getFormatted(),
            'user_ip' => (string)$this->getOrder()->getUserIp(),
            'currency' => (string)$this->getOption()->getCurrency()->value,
            'client_lang' => (string)$this->getOption()->getClientLang()->value,
            'merchant_ok_url' => (string)$this->getOption()->getSuccessUrl(),
            'merchant_fail_url' => (string)$this->getOption()->getFailUrl(),
            'debug_on' => (int)$this->getOption()->isDebugOn(),
            'test_mode' => (int)$this->getOption()->isTestMode(),
            'timeout_limit' => (int)$this->getOption()->getTimeOutLimit(),
        ];

        if ($this->getOption()->getTransactionType() == TransactionType::DIRECT) {
            $data['cc_owner'] = (string)$this->getOrder()->getCardOwner();
            $data['card_number'] = (string)$this->getOrder()->getCardNumber();
            $data['expiry_month'] = (string)$this->getOrder()->getCardExpireMonth();
            $data['expiry_year'] = (string)$this->getOrder()->getCardExpireYear();
            $data['cvv'] = (string)$this->getOrder()->getCardCvv();
            $data['payment_amount'] = (string)$this->getOrder()->getPaymentAmount();
            $data['payment_type'] = (string)PaymentType::CARD->value;
            $data['non_3d'] = (int)$this->getOption()->isNon3d();
            $data['non3d_test_failed'] = (int)$this->getOption()->isNon3dTestFailed();
            $data['sync_mode'] = (int)$this->getOption()->isSyncMode();
            $data['installment_count'] = (int)$this->getOption()->getInstallmentCount();

            if ($this->getOption()->getCardType() != null) {
                $data['card_type'] = (string)$this->getOption()->getCardType()->value;
            }
        }

        if ($this->getOption()->getTransactionType() == TransactionType::IFRAME) {
            $data['user_basket'] = (string)$this->getOrder()->getBasket()->getFormattedBase64();
            $data['payment_amount'] = (string)$this->getOrder()->getPaymentAmountFormatted();
            $data['no_installment'] = (int)$this->getOption()->isNoInstallment();
            $data['max_installment'] = (int)$this->getOption()->getMaxInstallment();
        }

        if ($this->getOption()->getTransactionType() == TransactionType::IFRAME_TRANSFER) {
            $data['payment_type'] = (string)PaymentType::EFT->value;
            $data['no_installment'] = (int)$this->getOption()->isNoInstallment();
            $data['max_installment'] = (int)$this->getOption()->getMaxInstallment();
            $data['payment_amount'] = (string)$this->getOrder()->getPaymentAmountFormatted();
        }

        return $data;
    }

    public function call(): Response
    {
        $data = $this->generateData();

        if ($this->getOption()->getTransactionType() == TransactionType::DIRECT) {
            $url = $this->getConfig()->getApiUrl() . '/odeme';
        } else {
            $url = $this->getConfig()->getApiUrl() . '/odeme/api/get-token';
        }
        $request = $this->client->request('POST', $url, [
            'form_params' => $data,
            'timeout' => $this->getOption()->getTimeOutLimit(),
        ]);

        $response = $request->getBody()->getContents();

        return new Response($response);
    }
}
