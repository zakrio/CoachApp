<?php

declare(strict_types=1);

use App\Models\Coach;
use App\Models\User;

it('list the coaches', function (): void {
    $user = User::factory()->create();

    $coaches = Coach::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('coaches.index'));

    $response->assertStatus(200);

    $response->assertJson([
        'coaches' => [
            'data' => $coaches->toArray(),
        ],
    ]);
});

it('filters coaches by name', function (): void {
    $user = User::factory()->create();

    Coach::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    Coach::factory()->count(1)->create([
        'name' => 'Marietta Jacobi',
        'user_id' => $user->id,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('coaches.index').'?search=Marietta');

    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => 'Marietta Jacobi']);
});

it('lists the coaches for an authenticated user', function (): void {
    $user = User::factory()->create();

    $token = $user->createToken('Admin Token')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => "Bearer $token",
    ])->getJson(route('coaches.index'));

    $response->assertStatus(200);
});

it('requires authentication for the coaches route', function (): void {
    $response = $this->getJson('/api/coaches');
    $response->assertStatus(401);
});

it('returns 404 for a non-existing coach', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->getJson('/api/coaches/9999');

    $response->assertStatus(404);
});
