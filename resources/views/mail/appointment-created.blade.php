@php use Carbon\CarbonImmutable; @endphp
<x-mail::message>
    # Appointment Created

    Hi {{ $appointment->user->name }},

    Your appointment with **Coach: {{ $appointment->coach->user->name }}** has been successfully created!

    **Start Date:** {{ CarbonImmutable::parse($appointment->start_date)->toIso8601String() }}
    **End Date:** {{ CarbonImmutable::parse($appointment->end_date)->toIso8601String() }}

    We look forward to seeing you!

    <x-mail::button :url="route('appointments.show', $appointment->id)">
        View Appointment
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
