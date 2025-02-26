<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\AppointmentStatus;
use App\Events\AppointmentApproved;

final class UpdateAppointmentStatusToApproved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentApproved $event): void
    {
        $appointment = $event->appointment;
        $appointment->status = AppointmentStatus::Approved;
        $appointment->save();
    }
}
