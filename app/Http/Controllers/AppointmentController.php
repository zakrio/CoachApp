<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateAppointment;
use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class AppointmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAppointmentRequest $request, CreateAppointment $action): JsonResponse
    {
        /** @var array{start_date: string, end_date: string, coach_id: int} $validated */
        $validated = $request->validated();

        $user = $request->user();

        abort_if(! $user, 401, 'User not authenticated');

        $appointment = $action->handle($user, $validated);

        return response()->json($appointment, ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment): JsonResponse
    {
        $user = request()->user();

        abort_if(! $user, 401, 'User not authenticated');
        abort_if($appointment->user_id !== $user->id, 403, 'Unauthorized access to the appointment.');

        return response()->json($appointment);
    }
}
