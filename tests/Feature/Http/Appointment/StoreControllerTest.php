<?php

declare(strict_types=1);

use App\Enums\AppointmentStatus;
use App\Mail\AppointmentCreated;
use App\Models\Appointment;
use App\Models\Coach;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Mail;

it('user creates an appointment', function (): void {
    Mail::fake();

    $user = User::factory()->create();
    $coach = Coach::factory()->create([
        'user_id' => $user->id,
    ]);
    $token = $user->createToken('Admin Token')->plainTextToken;

    $startDate = CarbonImmutable::now()->addDays(1)->startOfDay();
    $endDate = $startDate->addHour();

    $response = $this->withHeaders([
        'Authorization' => "Bearer $token",
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])
        ->postJson(route('appointments.store'), [
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $endDate->format('Y-m-d H:i:s'),
            'status' => AppointmentStatus::Pending->value,
            'coach_id' => $coach->id,
        ]);

    $response->assertStatus(201);

    Mail::assertSent(AppointmentCreated::class, fn ($mail): bool => $mail->hasTo($user->email) && $mail->hasTo($coach->user->email));

    $appointments = Appointment::all();

    expect($appointments)->toHaveCount(1)
        ->and($appointments->first()->user_id)->toBe($user->id)
        ->and($appointments->first()->coach_id)->toBe($coach->id)
        ->and($appointments->first()->start_date->toIso8601String())->toBe($startDate->toIso8601String())
        ->and($appointments->first()->status)->toBe(AppointmentStatus::Approved);
});
