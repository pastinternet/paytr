<?php

namespace Past\Paytr\Exceptions;

class InvalidConfigException extends PaytrException
{
    public function notFound()
    {
        return new static('Setup your credentials to config.paytr');
    }
}