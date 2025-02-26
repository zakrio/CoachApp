<?php

declare(strict_types=1);

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\User;

it('shows the appointment for the authorized user', function (): void {
    $user = User::factory()->create();

    $appointment = Appointment::factory()->create([
        'user_id' => $user->id,
        'status' => AppointmentStatus::Pending->value,
    ]);

    $token = $user->createToken('Test Token')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => "Bearer $token",
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])
        ->getJson(route('appointments.show', $appointment));

    $response->assertStatus(200);
});

it('returns 401 if the user is not authenticated', function (): void {
    $appointment = Appointment::factory()->create();

    $response = $this->getJson(route('appointments.show', $appointment));

    $response->assertStatus(401);
});

it('returns 403 if the user is not authorized to view the appointment', function (): void {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $appointment = Appointment::factory()->create([
        'user_id' => $user1->id,
    ]);

    $token = $user2->createToken('Test Token')->plainTextToken;
    $response = $this->withHeaders([
        'Authorization' => "Bearer $token",
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])
        ->getJson(route('appointments.show', $appointment));

    $response->assertStatus(403);
});
