<?php

namespace App\Providers;

use App\Events\InitialTeamCreated;
use App\Events\TransferCompleted;
use App\Events\UserRegistered;
use App\Listeners\ClosePlayerListing;
use App\Listeners\CreateInitialTeamForRegisteredUser;
use App\Listeners\GenerateInitialSquad;
use App\Listeners\IncreazePlayerMarketValue;
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
        UserRegistered::class => [
            SendEmailVerificationNotification::class,
            CreateInitialTeamForRegisteredUser::class,
        ],
        InitialTeamCreated::class => [
            GenerateInitialSquad::class,
        ],

        TransferCompleted::class => [
            IncreazePlayerMarketValue::class,
            ClosePlayerListing::class,
        ],
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
