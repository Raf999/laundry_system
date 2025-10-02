<?php

namespace App\Enum;

enum CompanyStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case BANNED = 'banned';
    case SUSPENDED = 'suspended';

    public function color(): string
    {
        return match($this) {
            self::PENDING   => 'yellow',   // or 'bg-yellow'
            self::APPROVED  => 'green',    // or 'bg-green'
            self::REJECTED  => 'red',      // or 'bg-red'
            self::BANNED    => 'black',    // or 'bg-gray'
            self::SUSPENDED => 'orange',   // or 'bg-orange'
        };
    }
}
