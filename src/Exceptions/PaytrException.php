<?php

namespace Past\Paytr\Exceptions;

use Exception;
use Throwable;

abstract class PaytrException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}