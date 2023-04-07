<?php

namespace Past\Paytr\Request;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Past\Paytr\PaytrClient;

class PaymentVerification extends PaytrClient
{
    private Request $request;

    private ?string $merchantOid;

    private ?string $status;

    private ?string $totalAmount;

    private ?string $hash;

    private ?string $failedReasonCode;

    private ?string $failedReasonMessage;

    private ?string $testMode;

    private ?string $paymentType;

    private ?string $currency;

    private ?float $paymentAmount;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setup();
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return string|null
     */
    public function getMerchantOid(): ?string
    {
        return $this->merchantOid;
    }

    /**
     * @param string|null $merchantOid
     */
    public function setMerchantOid(?string $merchantOid): void
    {
        $this->merchantOid = $merchantOid;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getTotalAmount(): ?string
    {
        return $this->totalAmount;
    }

    /**
     * @param string|null $totalAmount
     */
    public function setTotalAmount(?string $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param string|null $hash
     */
    public function setHash(?string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return string|null
     */
    public function getFailedReasonCode(): ?string
    {
        return $this->failedReasonCode;
    }

    /**
     * @param string|null $failedReasonCode
     */
    public function setFailedReasonCode(?string $failedReasonCode): void
    {
        $this->failedReasonCode = $failedReasonCode;
    }

    /**
     * @return string|null
     */
    public function getFailedReasonMessage(): ?string
    {
        return $this->failedReasonMessage;
    }

    /**
     * @param string|null $failedReasonMessage
     */
    public function setFailedReasonMessage(?string $failedReasonMessage): void
    {
        $this->failedReasonMessage = $failedReasonMessage;
    }

    /**
     * @return string|null
     */
    public function getTestMode(): ?string
    {
        return $this->testMode;
    }

    /**
     * @param string|null $testMode
     */
    public function setTestMode(?string $testMode): void
    {
        $this->testMode = $testMode;
    }

    /**
     * @return string|null
     */
    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    /**
     * @param string|null $paymentType
     */
    public function setPaymentType(?string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return float|null
     */
    public function getPaymentAmount(): ?float
    {
        return $this->paymentAmount;
    }

    /**
     * @param float|null $paymentAmount
     */
    public function setPaymentAmount(?float $paymentAmount): void
    {
        $this->paymentAmount = $paymentAmount;
    }

    public function setup()
    {
        $this->setMerchantOid($this->request->get('merchant_oid'));
        $this->setStatus($this->request->get('status'));
        $this->setTotalAmount($this->request->get('total_amount'));
        $this->setHash($this->request->get('hash'));
        $this->setFailedReasonCode($this->request->get('failed_reason_code'));
        $this->setFailedReasonMessage($this->request->get('failed_reason_msg'));
        $this->setTestMode($this->request->get('test_mode'));
        $this->setPaymentType($this->request->get('payment_type'));
        $this->setCurrency($this->request->get('currency'));
        $this->setPaymentAmount($this->request->get('payment_amount'));
    }

    public function isVerified(): bool
    {
        return ($this->generateHash() === $this->hash);
    }

    public function isSuccess(): bool
    {
        return ($this->status === 'success');
    }

    public function getProcessedResponse()
    {
        return response('OK', Response::HTTP_OK);
    }

    private function generateHash()
    {
        $hash = implode('', [
            $this->getMerchantOid(),
            $this->getCredentials()['merchant_salt'],
            $this->getStatus(),
            $this->getTotalAmount()
        ]);

        return base64_encode(hash_hmac('sha256', $hash, $this->getCredentials()['merchant_key'], true));
    }
}