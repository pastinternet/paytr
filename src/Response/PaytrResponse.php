<?php

namespace Past\Paytr\Response;

class PaytrResponse
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function isSuccess(): bool
    {
        return ($this->content['status'] === 'success');
    }

    public function getMessage()
    {
        return $this->content['reason'] ?? null;
    }

    public function getToken()
    {
        return $this->content['token'] ?? null;
    }
}