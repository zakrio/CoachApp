<?php

declare(strict_types=1);

use App\Models\Coach;
use App\Models\Cycle;
use App\Models\User;
use Carbon\CarbonImmutable;

it('shows the available dates for coaches', function (): void {
    $user = User::factory()->create();
    $coach = Coach::factory()->create(['user_id' => $user->id]);
    $cycle = Cycle::factory()->create([
        'start_date' => '2025-04-25',
        'end_date' => '2025-09-29',
        'type' => 'day',
        'coach_id' => $coach->id,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('coaches.show', ['coach' => $coach->id]));

    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => $coach->name]);

    expect(CarbonImmutable::parse($response->json('cycle.0.start_date'))->toDateString())
        ->toBe($cycle->start_date->toDateString());
});
