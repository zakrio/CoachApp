<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\AppointmentStatus;
use App\Events\AppointmentApproved;
use App\Mail\AppointmentCreated;
use App\Models\Appointment;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

final readonly class CreateAppointment
{
    /**
     * Execute the action.
     *
     * @param  array{start_date: string, end_date: string, coach_id: int}  $attributes
     */
    public function handle(User $user, array $attributes): Appointment
    {
        return DB::transaction(static function () use ($user, $attributes) {
            $appointment = Appointment::query()->create([
                'user_id' => $user->id,
                'status' => AppointmentStatus::Pending,
                'start_date' => $attributes['start_date'],
                'end_date' => $attributes['end_date'],
                'coach_id' => $attributes['coach_id'],
            ]);

            /** @var Coach $coach */
            $coach = Coach::query()->findOrFail($attributes['coach_id']);

            //            Mail::to($user->email)->send(new AppointmentCreated($appointment));
            //            Mail::to($coach->user->email)->send(new AppointmentCreated($appointment));

            if ($coach->user) {
                Mail::to($user->email)->send(new AppointmentCreated($appointment));

                if ($coach->user->email) {
                    Mail::to($coach->user->email)->send(new AppointmentCreated($appointment));
                }
            }

            event(new AppointmentApproved($appointment));

            return $appointment;
        });
    }
}
