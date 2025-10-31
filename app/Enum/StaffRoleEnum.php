<?php

namespace App\Enum;

enum StaffRoleEnum: string
{
//$table->enum('role',['admin', 'frontdesk', 'washer', 'ironer'])->default('frontdesk');

    case ADMIN = 'admin';
    case FRONTDESK = 'frontdesk';
    case WASHER = 'washer';
    case IRONER = 'ironer';
}
