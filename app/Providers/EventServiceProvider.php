<?php

namespace App\Providers;

use App\Events\customer\CustomerBankDetailLogEvent;
use App\Events\customer\CustomerDrivingLicenseLogEvent;
use App\Events\customer\CustomerLogEvent;
use App\Events\customer\CustomerPanCardLogEvent;
use App\Events\customer\CustomerPersonalInfoLogEvent;
use App\Events\customer\CustomerProfessionalInfoLogEvent;
use App\Events\customer\CustomerVoterCardLogEvent;
use App\Listeners\customer\CustomerBankDetailLogListener;
use App\Listeners\customer\CustomerDrivingLicenseLogListener;
use App\Listeners\customer\CustomerLogListener;
use App\Listeners\customer\CustomerPanCardLogListener;
use App\Listeners\customer\CustomerPersonalInfoLogListener;
use App\Listeners\customer\CustomerProfessionalInfoLogListener;
use App\Listeners\customer\CustomerVoterCardLogListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
