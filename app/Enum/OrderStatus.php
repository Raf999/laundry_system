<?php

namespace App\Enum;

enum OrderStatus: string
{
    case PROCESSING = 'processing';
    case READY_FOR_WASHING = 'ready_for_washing';
    case WASHED = 'washed';
    case READY_FOR_IRONING = 'ready_for_ironing';
    case IRONED = 'ironed';
    case READY_FOR_PICKUP = 'ready_for_pickup';
    case DELIVERED = 'delivered';
    case COMPLETED = 'completed';

    public function humanReadable(): string
    {
        return match($this) {
            self::PROCESSING => 'Processing',
            self::READY_FOR_WASHING => 'Ready for Washing',
            self::WASHED => 'Washed',
            self::READY_FOR_IRONING => 'Ready for Ironing',
            self::IRONED => 'Ironed',
            self::READY_FOR_PICKUP => 'Ready for Pickup',
            self::DELIVERED => 'Delivered',
            self::COMPLETED => 'Completed',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PROCESSING => 'bg-blue-100 text-blue-800',
            self::READY_FOR_WASHING => 'bg-cyan-100 text-cyan-800',
            self::WASHED => 'bg-teal-100 text-teal-800',
            self::READY_FOR_IRONING => 'bg-purple-100 text-purple-800',
            self::IRONED => 'bg-indigo-100 text-indigo-800',
            self::READY_FOR_PICKUP => 'bg-amber-100 text-amber-800',
            self::DELIVERED => 'bg-lime-100 text-lime-800',
            self::COMPLETED => 'bg-green-100 text-green-800',
        };
    }

    public function hexColor(): string
    {
        return match($this) {
            self::PROCESSING => '#2563eb',
            self::READY_FOR_WASHING => '#0891b2',
            self::WASHED => '#0d9488',
            self::READY_FOR_IRONING => '#9333ea',
            self::IRONED => '#4f46e5',
            self::READY_FOR_PICKUP => '#d97706',
            self::DELIVERED => '#65a30d',
            self::COMPLETED => '#16a34a',
        };
    }
}
