<?php

namespace Past\Paytr\Request;

use Past\Paytr\Enums\CardType;
use Past\Paytr\Enums\ClientLang;
use Past\Paytr\Enums\Currency;
use Past\Paytr\Enums\PaymentType;
use Past\Paytr\PaytrClient;
use Past\Paytr\Response\PaytrResponse;

class Payment extends PaytrClient
{
    private string $userIp;
    private string $merchantOid;
    private string $email;
    private PaymentType $paymentType = PaymentType::CARD;
    private float $paymentAmount;
    private int $installmentCount;
    private ?CardType $cardType;
    private Currency $currency = Currency::TRY;
    private ClientLang $clientLang = ClientLang::TR;
    private bool $testMode = false;
    private bool $non3d = false;
    private bool $non3dTestFailed = false;
    private string $cardOwner;
    private string $cardNumber;
    private string $cardExpireMonth;
    private string $cardExpireYear;
    private string $cardCvv;
    private string $successUrl;
    private string $failUrl;
    private string $userName;
    private string $userAddress;
    private string $userPhone;
    private Basket $basket;
    private bool $debugOn = false;
    private bool $syncMode = false;

    /**
     * @return string
     */
    public function getUserIp(): string
    {
        return $this->userIp;
    }

    /**
     * @param string $userIp
     */
    public function setUserIp(string $userIp): void
    {
        $this->userIp = $userIp;
    }

    /**
     * @return string
     */
    public function getMerchantOid(): string
    {
        return $this->merchantOid;
    }

    /**
     * @param string $merchantOid
     */
    public function setMerchantOid(string $merchantOid): void
    {
        $this->merchantOid = $merchantOid;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return PaymentType
     */
    public function getPaymentType(): PaymentType
    {
        return $this->paymentType;
    }

    /**
     * @param PaymentType $paymentType
     */
    public function setPaymentType(PaymentType $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return float
     */
    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    public function getFormattedPaymentAmount(): string
    {
        return $this->getPaymentAmount() * 100;
    }

    /**
     * @param float $paymentAmount
     */
    public function setPaymentAmount(float $paymentAmount): void
    {
        $this->paymentAmount = $paymentAmount;
    }

    /**
     * @return int
     */
    public function getInstallmentCount(): int
    {
        return $this->installmentCount;
    }

    /**
     * @param int $installmentCount
     */
    public function setInstallmentCount(int $installmentCount): void
    {
        $this->installmentCount = $installmentCount;
    }

    /**
     * @return CardType|null
     */
    public function getCardType(): ?CardType
    {
        return $this->cardType;
    }

    /**
     * @param CardType|null $cardType
     */
    public function setCardType(?CardType $cardType): void
    {
        $this->cardType = $cardType;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return ClientLang
     */
    public function getClientLang(): ClientLang
    {
        return $this->clientLang;
    }

    /**
     * @param ClientLang $clientLang
     */
    public function setClientLang(ClientLang $clientLang): void
    {
        $this->clientLang = $clientLang;
    }

    /**
     * @return bool
     */
    public function isTestMode(): bool
    {
        return $this->testMode;
    }

    /**
     * @param bool $testMode
     */
    public function setTestMode(bool $testMode): void
    {
        $this->testMode = $testMode;
    }

    /**
     * @return bool
     */
    public function isNon3d(): bool
    {
        return $this->non3d;
    }

    /**
     * @param bool $non3d
     */
    public function setNon3d(bool $non3d): void
    {
        $this->non3d = $non3d;
    }

    /**
     * @return bool
     */
    public function isNon3dTestFailed(): bool
    {
        return $this->non3dTestFailed;
    }

    /**
     * @param bool $non3dTestFailed
     */
    public function setNon3dTestFailed(bool $non3dTestFailed): void
    {
        $this->non3dTestFailed = $non3dTestFailed;
    }

    /**
     * @return string
     */
    public function getCardOwner(): string
    {
        return $this->cardOwner;
    }

    /**
     * @param string $cardOwner
     */
    public function setCardOwner(string $cardOwner): void
    {
        $this->cardOwner = $cardOwner;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getCardExpireMonth(): string
    {
        return $this->cardExpireMonth;
    }

    /**
     * @param string $cardExpireMonth
     */
    public function setCardExpireMonth(string $cardExpireMonth): void
    {
        $this->cardExpireMonth = $cardExpireMonth;
    }

    /**
     * @return string
     */
    public function getCardExpireYear(): string
    {
        return $this->cardExpireYear;
    }

    /**
     * @param string $cardExpireYear
     */
    public function setCardExpireYear(string $cardExpireYear): void
    {
        $this->cardExpireYear = $cardExpireYear;
    }

    /**
     * @return string
     */
    public function getCardCvv(): string
    {
        return $this->cardCvv;
    }

    /**
     * @param string $cardCvv
     */
    public function setCardCvv(string $cardCvv): void
    {
        $this->cardCvv = $cardCvv;
    }

    /**
     * @return string
     */
    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl(string $successUrl): void
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @return string
     */
    public function getFailUrl(): string
    {
        return $this->failUrl;
    }

    /**
     * @param string $failUrl
     */
    public function setFailUrl(string $failUrl): void
    {
        $this->failUrl = $failUrl;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserAddress(): string
    {
        return $this->userAddress;
    }

    /**
     * @param string $userAddress
     */
    public function setUserAddress(string $userAddress): void
    {
        $this->userAddress = $userAddress;
    }

    /**
     * @return string
     */
    public function getUserPhone(): string
    {
        return $this->userPhone;
    }

    /**
     * @param string $userPhone
     */
    public function setUserPhone(string $userPhone): void
    {
        $this->userPhone = $userPhone;
    }

    /**
     * @return Basket
     */
    public function getBasket(): Basket
    {
        return $this->basket;
    }

    /**
     * @param Basket $basket
     */
    public function setBasket(Basket $basket): void
    {
        $this->basket = $basket;
    }

    /**
     * @return bool
     */
    public function isDebugOn(): bool
    {
        return $this->debugOn;
    }

    /**
     * @param bool $debugOn
     */
    public function setDebugOn(bool $debugOn): void
    {
        $this->debugOn = $debugOn;
    }

    /**
     * @return bool
     */
    public function isSyncMode(): bool
    {
        return $this->syncMode;
    }

    /**
     * @param bool $syncMode
     */
    public function setSyncMode(bool $syncMode): void
    {
        $this->syncMode = $syncMode;
    }

    public function getHash(): string
    {
        return implode('',[
            $this->getCredentials()['merchant_id'],
            $this->getUserIp(),
            $this->getMerchantOid(),
            $this->getEmail(),
            $this->getFormattedPaymentAmount(),
            $this->getPaymentType(),
            $this->getInstallmentCount(),
            $this->getCurrency(),
            $this->getOptions()['test_mode'] ? '1' : '0',
            $this->isNon3d() ? '1' : '0',
        ]);
    }
    private function createPaymentToken()
    {
        $hash = $this->getHash();
        return base64_encode(hash_hmac('sha256', $hash . $this->getCredentials()['merchant_salt'], $this->getCredentials()['merchant_key'], true));
    }

    public function getBody()
    {
        return [
            'merchant_id' => $this->getCredentials()['merchant_id'],
            'payment_token' => $this->createPaymentToken(),
            'user_ip' => $this->getUserIp(),
            'merchant_oid' => $this->getMerchantOid(),
            'email' => $this->getEmail(),
            'payment_type' => $this->getPaymentType(),
            'payment_amount' => $this->getPaymentAmount(),
            'installment_count' => $this->getInstallmentCount(),
            'card_type' => $this->getCardType(),
            'currency' => $this->getCurrency(),
            'client_lang' => $this->getClientLang(),
            'test_mode' => $this->getOptions()['test_mode'] ? '1' : '0',
            'non_3d' => $this->isNon3d() ? '1' : '0',
            'non_3d_test_failed' => $this->isNon3dTestFailed() ? '1' : '0',
            'cc_owner' => $this->getCardOwner(),
            'card_number' => $this->getCardNumber(),
            'expiry_month' => $this->getCardExpireMonth(),
            'expiry_year' => $this->getCardExpireYear(),
            'cvv' => $this->getCardCvv(),
            'merchant_ok_url' => $this->getSuccessUrl(),
            'merchant_fail_url' => $this->getFailUrl(),
            'user_name' => $this->getUserName(),
            'user_address' => $this->getUserAddress(),
            'user_phone' => $this->getUserPhone(),
            'user_basket' => $this->getBasket()->getFormatted(),
            'debug_on' => $this->isDebugOn() ? '1' : '0',
            'sync_mode' => $this->isSyncMode() ? '1' : '0',
        ];
    }

    /**
     * @return PaytrResponse
     */
    public function create():PaytrResponse
    {
        $response = $this->call('POST', 'odeme/api/get-token', $this->getBody());

        return new PaytrResponse(json_decode((string)$response->getBody(), true));
    }
}