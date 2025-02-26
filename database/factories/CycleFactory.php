<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CycleType;
use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cycle>
 */
final class CycleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'type' => CycleType::Day->value,
            'coach_id' => Coach::factory(),
        ];
    }
}
