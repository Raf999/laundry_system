<?php

namespace App\Enum;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case MOBILE_MONEY = 'mobile_money';
    case CARD = 'card';
}
