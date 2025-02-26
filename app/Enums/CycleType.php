<?php

declare(strict_types=1);

namespace App\Enums;

enum CycleType: string
{
    /** Specific day */
    case Day = 'day';

    /** Weekly schedule */
    case Weekly = 'weekly';
}
