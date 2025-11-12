<?php

namespace App\Enum;

enum DeliveryType: string
{
    case STORE_PICKUP = 'pickup';
    case DELIVERY = 'delivery';
    case ROUND_TRIP = 'round_trip';
}
