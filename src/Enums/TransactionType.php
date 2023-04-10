<?php

namespace Past\Paytr\Enums;

enum TransactionType: string
{
    case DIRECT = 'DIRECT';
    case IFRAME = 'IFRAME';
    case IFRAME_TRANSFER = 'IFRAME_TRANSFER';
}
