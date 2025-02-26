<?php

declare(strict_types=1);

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', static fn (User $user, int $id): bool => (int) $user->id === $id);

Broadcast::channel('appointment.{appointmentId}', static function (User $user, int $appointmentId): Appointment {
    /** @var Appointment $appointment */
    $appointment = Appointment::query()->findOrFail($appointmentId);

    return $appointment;
});
