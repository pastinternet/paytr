<?php

namespace Past\Paytr\Facade;

use Illuminate\Support\Facades\Facade;
use Past\Paytr\PaytrClient;

class Paytr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaytrClient::class;
    }
}