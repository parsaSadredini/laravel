<?php

namespace App\Providers;

use App\Events\NewCustomHasRegisteredEvent;
use App\Events\NewMemberHasRegisteredEvent;
use App\Events\NewUserRegistered;
use App\Listeners\WelcomeNewMemberListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewUserRegistered::class => [
            \App\Listeners\WelcomeNewUser::class,
            \App\Listeners\WelcomeNewUserBySmsListener::class
        ],
        NewMemberHasRegisteredEvent::class=>[
            WelcomeNewMemberListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
