<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const USER_ROLE = [
        0 => 'admin',
        1 => 'author'
    ];
}
