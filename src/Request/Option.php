<?php

namespace Past\Paytr\Request;

use Past\Paytr\Enums\CardType;
use Past\Paytr\Enums\ClientLang;
use Past\Paytr\Enums\Currency;
use Past\Paytr\Enums\PaymentType;
use Past\Paytr\Enums\TransactionType;

class Option
{
    private string $successUrl;
    private string $failUrl;
    private bool $debugOn = false;
    private bool $testMode = false;
    private int $timeOutLimit = 30;
    private ?CardType $cardType = null;
    private PaymentType $paymentType = PaymentType::CARD;
    private ClientLang $clientLang = ClientLang::TR;
    private Currency $currency = Currency::TL;
    private TransactionType $transactionType = TransactionType::DIRECT;
    private bool $syncMode = false;
    private bool $non3d = false;
    private bool $non3dTestFailed = true;
    private int $installmentCount = 0;
    private bool $noInstallment = false;
    private int $maxInstallment = 0;

    public function __construct(?array $options = [])
    {
        if ($options) {
            if (isset($options['success_url'])) {
                $this->setSuccessUrl($options['success_url']);
            }
            if (isset($options['fail_url'])) {
                $this->setFailUrl($options['fail_url']);
            }
            if (isset($options['debug_on'])) {
                $this->setDebugOn($options['debug_on']);
            }
            if (isset($options['test_mode'])) {
                $this->setTestMode($options['test_mode']);
            }
            if (isset($options['timeout_limit'])) {
                $this->setTimeOutLimit($options['timeout_limit']);
            }
            if (isset($options['card_type'])) {
                $this->setCardType($options['card_type']);
            }
            if (isset($options['payment_type'])) {
                $this->setPaymentType($options['payment_type']);
            }
            if (isset($options['client_lang'])) {
                $this->setClientLang($options['client_lang']);
            }
            if (isset($options['currency'])) {
                $this->setCurrency($options['currency']);
            }
            if (isset($options['transaction_type'])) {
                $this->setTransactionType($options['transaction_type']);
            }
            if (isset($options['sync_mode'])) {
                $this->setSyncMode($options['sync_mode']);
            }
            if (isset($options['non3d'])) {
                $this->setNon3d($options['non3d']);
            }
            if (isset($options['non3d_test_failed'])) {
                $this->setNon3dTestFailed($options['non3d_test_failed']);
            }
            if (isset($options['installment_count'])) {
                $this->setInstallmentCount($options['installment_count']);
            }
            if (isset($options['no_installment'])) {
                $this->setNoInstallment($options['no_installment']);
            }
            if (isset($options['max_installment'])) {
                $this->setMaxInstallment($options['max_installment']);
            }
        }
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
     * @return Option
     */
    public function setSuccessUrl(string $successUrl): Option
    {
        $this->successUrl = $successUrl;
        return $this;
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
     * @return Option
     */
    public function setFailUrl(string $failUrl): Option
    {
        $this->failUrl = $failUrl;
        return $this;
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
     * @return Option
     */
    public function setDebugOn(bool $debugOn): Option
    {
        $this->debugOn = $debugOn;
        return $this;
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
     * @return Option
     */
    public function setTestMode(bool $testMode): Option
    {
        $this->testMode = $testMode;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeOutLimit(): int
    {
        return $this->timeOutLimit;
    }

    /**
     * @param int $timeOutLimit
     * @return Option
     */
    public function setTimeOutLimit(int $timeOutLimit): Option
    {
        $this->timeOutLimit = $timeOutLimit;
        return $this;
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
     * @return Option
     */
    public function setCardType(?CardType $cardType): Option
    {
        $this->cardType = $cardType;
        return $this;
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
     * @return Option
     */
    public function setPaymentType(PaymentType $paymentType): Option
    {
        $this->paymentType = $paymentType;
        return $this;
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
     * @return Option
     */
    public function setClientLang(ClientLang $clientLang): Option
    {
        $this->clientLang = $clientLang;
        return $this;
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
     * @return Option
     */
    public function setCurrency(Currency $currency): Option
    {
        $this->currency = $currency;
        return $this;
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
     * @return Option
     */
    public function setSyncMode(bool $syncMode): Option
    {
        $this->syncMode = $syncMode;
        return $this;
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
     * @return Option
     */
    public function setNon3d(bool $non3d): Option
    {
        $this->non3d = $non3d;
        return $this;
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
     * @return Option
     */
    public function setNon3dTestFailed(bool $non3dTestFailed): Option
    {
        $this->non3dTestFailed = $non3dTestFailed;
        return $this;
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
     * @return Option
     */
    public function setInstallmentCount(int $installmentCount): Option
    {
        $this->installmentCount = $installmentCount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNoInstallment(): bool
    {
        return $this->noInstallment;
    }

    /**
     * @param bool $noInstallment
     * @return Option
     */
    public function setNoInstallment(bool $noInstallment): Option
    {
        $this->noInstallment = $noInstallment;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxInstallment(): int
    {
        return $this->maxInstallment;
    }

    /**
     * @param int $maxInstallment
     * @return Option
     */
    public function setMaxInstallment(int $maxInstallment): Option
    {
        $this->maxInstallment = $maxInstallment;
        return $this;
    }

    /**
     * @return TransactionType
     */
    public function getTransactionType(): TransactionType
    {
        return $this->transactionType;
    }

    /**
     * @param TransactionType $transactionType
     * @return Option
     */
    public function setTransactionType(TransactionType $transactionType): Option
    {
        $this->transactionType = $transactionType;
        return $this;
    }
}
