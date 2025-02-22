<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        $this->configurePasswords();
    }

    /**
     * Configuring the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );
    }

    /**
     * Configuring the application models.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict();

        Model::unguard();
    }

    /**
     * Configuring the application dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Configuring the application password validation rules.
     */
    private function configurePasswords(): void
    {
        Password::defaults(fn () => $this->app->isProduction() ? Password::min(8)->uncompromised() : null);
    }
}
