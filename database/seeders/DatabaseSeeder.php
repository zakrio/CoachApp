<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Coach;
use App\Models\Cycle;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $token = $user->createToken('admin')->plainTextToken;

        Log::info('Generated Token: '.$token);

        Coach::factory(10)->create();

        Cycle::factory(10)->create();

        Appointment::factory(10)->create();
    }
}
