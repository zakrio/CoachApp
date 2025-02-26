<?php

declare(strict_types=1);

use App\Enums\AppointmentStatus;
use App\Events\AppointmentApproved;
use App\Models\Appointment;
use App\Models\User;

it('can broadcast the appointment approved event', function (): void {
    $user = User::factory()->create();
    $appointment = Appointment::factory()->create([
        'user_id' => $user->id,
        'status' => 'pending',
    ]);

    event(new AppointmentApproved($appointment));

    expect($appointment->status)->toBe(AppointmentStatus::Approved);
});
