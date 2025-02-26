<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\AppointmentApproved;
use App\Listeners\UpdateAppointmentStatusToApproved;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, list<class-string>>
     */
    protected $listen = [
        AppointmentApproved::class => [
            UpdateAppointmentStatusToApproved::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
