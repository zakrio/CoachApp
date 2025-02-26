<?php

declare(strict_types=1);

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Coach;
use App\Models\User;

it('to array', function (): void {
    $appointment = Appointment::factory()->create()->fresh();

    expect(array_keys($appointment->toArray()))->toBe([
        'id',
        'start_date',
        'end_date',
        'status',
        'user_id',
        'coach_id',
        'created_at',
        'updated_at',
    ]);
});

it('relations', function (): void {
    $appointment = Appointment::factory()->create();

    expect($appointment->coach)->toBeInstanceOf(Coach::class)
        ->and($appointment->status)->toBeInstanceOf(AppointmentStatus::class)
        ->and($appointment->user)->toBeInstanceOf(User::class);
});

it('casts', function (): void {
    $appointment = Appointment::factory()->count(2)->create();

    expect($appointment->first()->status)->toBeInstanceOf(AppointmentStatus::class);
});
