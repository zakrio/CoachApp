<?php

declare(strict_types=1);

namespace App\Enums;

enum AppointmentStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Cancelled = 'cancelled';
}
