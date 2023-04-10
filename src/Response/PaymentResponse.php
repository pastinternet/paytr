<?php

namespace Past\Paytr\Response;

class PaymentResponse
{
    /**
     * @var array
     */
    private array $content;

    /**
     * @var string
     */
    private string $html;

    /**
     * @var bool
     */
    private bool $isSuccess;

    /**
     * @var bool
     */
    private bool $isHtml;

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array $content
     * @return PaymentResponse
     */
    public function setContent(array $content): PaymentResponse
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     * @return PaymentResponse
     */
    public function setHtml(string $html): PaymentResponse
    {
        $this->html = $html;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @param bool $isSuccess
     * @return PaymentResponse
     */
    public function setIsSuccess(bool $isSuccess): PaymentResponse
    {
        $this->isSuccess = $isSuccess;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->isHtml;
    }

    /**
     * @param bool $isHtml
     * @return PaymentResponse
     */
    public function setIsHtml(bool $isHtml): PaymentResponse
    {
        $this->isHtml = $isHtml;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        $content = $this->getContent();

        return isset($content['reason']) ? $content['reason'] : null;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        $content = $this->getContent();

        return isset($content['token']) ? $content['token'] : null;
    }
}
