<?php

declare(strict_types=1);

use App\Models\Appointment;
use App\Models\Coach;
use App\Models\Cycle;
use App\Models\User;

it('to array', function (): void {
    $coach = Coach::factory()->create()->fresh();

    expect(array_keys($coach->toArray()))->toBe([
        'id',
        'name',
        'email',
        'phone',
        'user_id',
        'created_at',
        'updated_at',
    ]);
});

it('relations', function (): void {
    $coach = Coach::factory()->create();

    Cycle::factory()->count(3)->create([
        'coach_id' => $coach->id,
    ]);

    Appointment::factory()->count(3)->create([
        'coach_id' => $coach->id,
    ]);

    expect($coach->cycles)->toHaveCount(3)
        ->and($coach->cycles->first())->toBeInstanceOf(Cycle::class)
        ->and($coach->appointments->first())->toBeInstanceOf(Appointment::class);
});

it('can retrieve the user of the coach', function (): void {
    $user = User::factory()->create();
    $coach = Coach::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($coach->user->id)->toEqual($user->id);
});
