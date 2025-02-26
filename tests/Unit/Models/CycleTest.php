<?php

declare(strict_types=1);

use App\Enums\CycleType;
use App\Models\Coach;
use App\Models\Cycle;

it('to array', function (): void {
    $cycle = Cycle::factory()->create()->fresh();

    expect(array_keys($cycle->toArray()))->toBe([
        'id',
        'start_date',
        'end_date',
        'type',
        'coach_id',
        'created_at',
        'updated_at',
    ]);
});

it('relations', function (): void {
    $cycle = Cycle::factory()->create();

    expect($cycle->coach)->toBeInstanceOf(Coach::class);
});

it('casts', function (): void {
    $cycle = Cycle::factory()->create()->fresh();

    expect($cycle->start_date)->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->and($cycle->end_date)->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->and($cycle->type)->toBeInstanceOf(CycleType::class);
});
