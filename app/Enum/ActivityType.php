<?php

namespace App\Enum;

enum ActivityType: string
{
    case ORDERS = 'orders';
    case CUSTOMERS = 'customers';
    case PAYMENTS = 'payments';

    // associate color with each activity type
    public function color(): string
    {
        return match($this) {
            self::ORDERS => 'blue',
            self::CUSTOMERS => 'green',
            self::PAYMENTS => 'amber',
        };
    }
}
