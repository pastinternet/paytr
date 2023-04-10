<?php

namespace Past\Paytr\Request;

use Past\Paytr\Enums\CardType;

class Order
{
    private string $merchantOrderId;
    private float $paymentAmount;
    private string $userName;
    private string $userAddress;
    private string $email;
    private string $userPhone;
    private string $userIp;
    private Basket $basket;
    private ?string $cardOwner;
    private ?string $cardNumber;
    private ?string $cardExpireMonth;
    private ?string $cardExpireYear;
    private ?string $cardCvv;
    private string $hash;

    /**
     * @return string
     */
    public function getMerchantOrderId(): string
    {
        return $this->merchantOrderId;
    }

    /**
     * @param string $merchantOrderId
     * @return Order
     */
    public function setMerchantOrderId(string $merchantOrderId): Order
    {
        $this->merchantOrderId = $merchantOrderId;
        return $this;
    }

    /**
     * @return float
     */
    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    public function getPaymentAmountFormatted(): int
    {
        return (int)str_replace('.', '', (string)($this->getPaymentAmount() * 100));
    }

    /**
     * @param float $paymentAmount
     * @return Order
     */
    public function setPaymentAmount(float $paymentAmount): Order
    {
        $this->paymentAmount = $paymentAmount;
        return $this;
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
     * @return Order
     */
    public function setUserName(string $userName): Order
    {
        $this->userName = $userName;
        return $this;
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
     * @return Order
     */
    public function setUserAddress(string $userAddress): Order
    {
        $this->userAddress = $userAddress;
        return $this;
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
     * @return Order
     */
    public function setEmail(string $email): Order
    {
        $this->email = $email;
        return $this;
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
     * @return Order
     */
    public function setUserPhone(string $userPhone): Order
    {
        $this->userPhone = $userPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserIp(): string
    {
        return $this->userIp;
    }

    /**
     * @param string $userIp
     * @return Order
     */
    public function setUserIp(string $userIp): Order
    {
        $this->userIp = $userIp;
        return $this;
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
     * @return Order
     */
    public function setBasket(Basket $basket): Order
    {
        $this->basket = $basket;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardOwner(): ?string
    {
        return $this->cardOwner;
    }

    /**
     * @param string|null $cardOwner
     * @return Order
     */
    public function setCardOwner(?string $cardOwner): Order
    {
        $this->cardOwner = $cardOwner;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    /**
     * @param string|null $cardNumber
     * @return Order
     */
    public function setCardNumber(?string $cardNumber): Order
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardExpireMonth(): ?string
    {
        return $this->cardExpireMonth;
    }

    /**
     * @param string|null $cardExpireMonth
     * @return Order
     */
    public function setCardExpireMonth(?string $cardExpireMonth): Order
    {
        $this->cardExpireMonth = $cardExpireMonth;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardExpireYear(): ?string
    {
        return $this->cardExpireYear;
    }

    /**
     * @param string|null $cardExpireYear
     * @return Order
     */
    public function setCardExpireYear(?string $cardExpireYear): Order
    {
        $this->cardExpireYear = $cardExpireYear;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardCvv(): ?string
    {
        return $this->cardCvv;
    }

    /**
     * @param string|null $cardCvv
     * @return Order
     */
    public function setCardCvv(?string $cardCvv): Order
    {
        $this->cardCvv = $cardCvv;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Order
     */
    public function setHash(string $hash): Order
    {
        $this->hash = $hash;
        return $this;
    }
}
