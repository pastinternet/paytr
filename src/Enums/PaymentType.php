<?php

namespace Past\Paytr\Enums;

enum PaymentType: string
{
    case CARD = 'card';
    case EFT = 'eft';
}
